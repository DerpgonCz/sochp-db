<?php

namespace App\Http\Controllers;

use App\Enums\LitterStateEnum;
use App\Facades\Flashes;
use App\Http\Requests\LitterStoreRequest;
use App\Http\Requests\LitterUpdateRequest;
use App\Models\Animal;
use App\Models\Litter;
use App\Models\Station;
use App\Services\Frontend\Animal\AnimalColorBuilderValueSerializer;
use App\Services\Frontend\Animal\AnimalSelectDataService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class LitterController extends Controller
{
    public function index(): View
    {
        $stationLitters = null;
        $litterForApproval = [];
        $littersForRegistration = [];

        if (Auth::check() && Auth::user()->station) {
            $stationLitters = Auth::user()->station?->litters()
                ->orderByDesc('happened_on')
                ->paginate(50, pageName: 'stationLittersPage');
        }

        $approvedLitters = Litter::approved()
            ->orderByDesc('happened_on')
            ->with(['children', 'father', 'mother', 'station'])
            ->paginate(50, pageName: 'littersPage');

        if (Gate::check('approve', Station::class)) {
            $litterForApproval =
                Litter::toApprove()
                    ->orderByDesc('happened_on')
                    ->with('station')
                    ->paginate(50, pageName: 'littersForApprovalPage');

            $littersForRegistration = Litter::toRegister()
                ->orderByDesc('happened_on')
                ->with('station')
                ->paginate(50, pageName: 'littersForRegistrationPage');
        }
        return view('models.litter.index', [
            'litters' => $approvedLitters,
            'stationLitters' => $stationLitters,
            'littersForApproval' => $litterForApproval,
            'littersForRegistration' => $littersForRegistration,
        ]);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(AnimalSelectDataService $animalSelectDataService): View
    {
        $this->authorize('create', Litter::class);

        $station = Auth::user()->station->with('animals', 'animals.litter')->first();

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
        $litter->mother()->associate(Animal::find($data['mother_id']));
        $litter->father()->associate(Animal::find($data['father_id']));
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

        $station = Auth::user()->station->with('animals', 'animals.litter')->first();

        return view('models.litter.edit', [
            'litter' => $litter,
            ...$animalSelectDataService->buildViewDataForParentSelection($station),
            'today' => date('Y-m-d'),
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
                        'color_shaded' => $deserializedColor['shaded'],
                        'color_full' => $deserializedColor['full'],
                        'color_mink' => $deserializedColor['mink'],
                        'litter_id' => $litter->id,
                        'mother_id' => $litter->mother_id,
                        'father_id' => $litter->father_id,
                    ]
                );
            });

        // State logic
        $flashMessage = 'flashes.litters.updated';
        if ($request->has('state')) {
            $toState = LitterStateEnum::fromValue((int) $request->get('state'));
            $this->authorize('updateState', [$litter, $toState]);

            $flashMessages = [
                LitterStateEnum::REQUIRES_DRAFT_CHANGES => 'flashes.litters.state.requires_draft_changes',
                LitterStateEnum::REQUIRES_BREEDING_APPROVAL => 'flashes.litters.state.requires_breeding_approval',
                LitterStateEnum::BREEDING => 'flashes.litters.state.breeding',
                LitterStateEnum::REQUIRES_BREEDING_CHANGES => 'flashes.litters.state.requires_breeding_changes',
                LitterStateEnum::REQUIRES_FINAL_APPROVAL => 'flashes.litters.state.requires_final_approval',
                LitterStateEnum::FINALIZED => 'flashes.litters.state.finalized',
                LitterStateEnum::REGISTERED => 'flashes.litters.state.registered',
            ];

            $litter->state = $toState;

            $flashMessage = $flashMessages[$toState->value] ?: $flashMessage;
        }

        $litter->save();

        Flashes::success(__($flashMessage));

        return response()->redirectToRoute('litters.show', $litter);
    }

    public function destroy(Litter $litter): RedirectResponse
    {
        $this->authorize('destroy', $litter);

        $litter->delete();

        Flashes::success(__('flashes.litters.deleted'));

        return response()->redirectToRoute('litters.index');
    }
}
