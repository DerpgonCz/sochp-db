<?php

namespace App\Http\Controllers;

use App\Enums\LitterStateEnum;
use App\Facades\Flashes;
use App\Http\Requests\LitterStoreRequest;
use App\Http\Requests\LitterUpdateRequest;
use App\Models\Animal;
use App\Models\Litter;
use App\Services\Frontend\Animal\AnimalColorBuilderValueSerializer;
use App\Services\Frontend\Animal\AnimalSelectDataService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LitterController extends Controller
{
    public function index(): View
    {
        return view('models.litter.index', [
            'stationLitters' => Auth::check() ? optional(Auth::user()->station)->litters ?? [] : [],
            'litters' => Litter::approved()->orderByDesc('happened_on')->with(['children', 'father', 'mother'])->get(),
            'littersForApproval' => Litter::whereIn('state', [LitterStateEnum::REQUIRES_BREEDING_APPROVAL, LitterStateEnum::REQUIRES_FINAL_APPROVAL])
                ->get(),
        ]);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(AnimalSelectDataService $animalSelectDataService): View
    {
        $this->authorize('create', Litter::class);

        $station = Auth::user()->station()->with('animals', 'animals.litter')->first();

        return view('models.litter.create', [
            'station' => $station,
            ...$animalSelectDataService->buildViewDataForParentSelection($station),
        ]);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(LitterStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Litter::class);

        $data = $request->validated();

        $litter = Litter::make($data);
        $litter->mother()->associate(Animal::find($data['mother']));
        $litter->father()->associate(Animal::find($data['father']));
        $litter->station()->associate(Auth::user()->station);
        $litter->state = LitterStateEnum::DRAFT;
        $litter->save();

        return response()->redirectToRoute('litters.show', $litter);
    }

    public function show(Litter $litter): View
    {
        $this->authorize('view', $litter);

        return view('models.litter.show', [
            'litter' => $litter->load(['mother', 'father']),
        ]);
    }

    public function edit(Litter $litter, AnimalSelectDataService $animalSelectDataService): View|RedirectResponse
    {
        try {
            $this->authorize('update', $litter);
        } catch (AuthorizationException) {
            return response()->redirectToRoute('litters.show', $litter);
        }

        $station = Auth::user()->station()->with('animals', 'animals.litter')->first();

        return view('models.litter.edit', [
            'litter' => $litter,
            ...$animalSelectDataService->buildViewDataForParentSelection($station),
        ]);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(LitterUpdateRequest $request, Litter $litter)
    {
        $this->authorize('update', $litter);

        $litter->fill($request->validated());
        $litter->save();

        // Animals logic
        collect($request->get('animals'))
            ->each(static function (array $animal) use ($litter): void {
                $deserializedColor = AnimalColorBuilderValueSerializer::deserialize($animal['color']);
                Animal::updateOrCreate(
                    ['id' => $animal['id'] ?? null],
                    [
                        ...collect($animal)->except(['id', 'color'])->toArray(),
                        'color_shaded' => $deserializedColor[0],
                        'color_full' => $deserializedColor[1],
                        'color_mink' => $deserializedColor[2],
                        'litter_id' => $litter->id,
                    ]
                );
            });

        // State logic
        $redirect = ['litters.edit', $litter];
        $flashMessage = 'flashes.litters.updated';
        if ($request->has('state')) {
            $toState = LitterStateEnum::fromValue((int)$request->get('state'));
            $this->authorize('updateState', [$litter, $toState]);

            $redirectTransitions = [
                LitterStateEnum::REQUIRES_DRAFT_CHANGES => ['litters.index'],
                LitterStateEnum::REQUIRES_BREEDING_APPROVAL => ['litters.show', $litter],
                LitterStateEnum::BREEDING => ['litters.index'],
                LitterStateEnum::REQUIRES_BREEDING_CHANGES => ['litters.index'],
                LitterStateEnum::REQUIRES_FINAL_APPROVAL => ['litters.show', $litter],
                LitterStateEnum::FINALIZED => ['litters.index'],
            ];
            $flashMessages = [
                LitterStateEnum::REQUIRES_DRAFT_CHANGES => 'flashes.litters.state.requires_draft_changes',
                LitterStateEnum::REQUIRES_BREEDING_APPROVAL => 'flashes.litters.state.requires_breeding_approval',
                LitterStateEnum::BREEDING => 'flashes.litters.state.breeding',
                LitterStateEnum::REQUIRES_BREEDING_CHANGES => 'flashes.litters.state.requires_breeding_changes',
                LitterStateEnum::REQUIRES_FINAL_APPROVAL => 'flashes.litters.state.requires_final_approval',
                LitterStateEnum::FINALIZED => 'flashes.litters.state.finalized',
            ];

            $litter->state = $toState;

            $redirect = $redirectTransitions[$toState->value];
            $flashMessage = $flashMessages[$toState->value] ?: $flashMessage;
        }

        $litter->save();

        Flashes::success(__($flashMessage));

        return response()->redirectToRoute(...$redirect);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Litter $litter
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Litter $litter)
    {
        //
    }
}
