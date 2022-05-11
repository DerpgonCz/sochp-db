<?php

namespace App\Http\Controllers;

use App\Enums\GenderEnum;
use App\Enums\LitterStateEnum;
use App\Enums\StationStateEnum;
use App\Http\Requests\LitterStoreRequest;
use App\Http\Requests\LitterUpdateRequest;
use App\Models\Animal;
use App\Models\Litter;
use App\Models\Station;
use App\Services\Models\Animal\AnimalSelectDataService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LitterController extends Controller
{
    public function index(): View
    {
        return view('models.litter.index', [
            'stationLitters' => Auth::check() ? optional(Auth::user()->station)->litters ?? [] : [],
            'litters' => Litter::approved()->orderByDesc('happened_on')->with(['children', 'father', 'mother'])->get(),
            'littersForApproval' => Litter::whereIn('state', [LitterStateEnum::REQUIRES_BREEDING_APPROVAL, LitterStateEnum::REQUIRES_FINAL_APPROVAL])->get(),
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
            ...$animalSelectDataService->buildViewDataForParentSelection($station)
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
            ...$animalSelectDataService->buildViewDataForParentSelection($station)
        ]);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(LitterUpdateRequest $request, Litter $litter)
    {
        $this->authorize('update', $litter);

        // TODO: Authorize editing only some fields - admin can edit only state, for example
        $litter->fill($request->validated());
        $litter->save();

        return response()->redirectToRoute('litters.edit', $litter);
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
