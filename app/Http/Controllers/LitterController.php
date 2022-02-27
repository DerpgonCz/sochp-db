<?php

namespace App\Http\Controllers;

use App\Enums\GenderEnum;
use App\Enums\LitterStateEnum;
use App\Http\Requests\LitterStoreRequest;
use App\Models\Animal;
use App\Models\Litter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LitterController extends Controller
{
    const SHOW_FIELDS = [
        'mother.name',
        'father.name',
    ];

    public function index(): View
    {
        return view('models.litter.index', [
            'stationLitters' => Auth::check() ? optional(Auth::user()->station)->litters ?? [] : [],
            'litters' => Litter::approved()->orderByDesc('happened_on')->get(),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Litter::class);

        $station = Auth::user()->station()->with('animals', 'animals.litter')->first();

        $stationAnimals = $station->animals
            ->sortBy('litter.happened_on');
        $otherAnimals = Animal::with('litter', 'litter.station')->get()
            ->sortBy('litter.happened_on')
            ->except($station->animals->keys()->toArray());

        return view('models.litter.create', [
            'station' => $station,
            'stationAnimalsMale' => $stationAnimals->where('gender', GenderEnum::MALE()),
            'stationAnimalsFemale' => $stationAnimals->where('gender', GenderEnum::FEMALE()),
            'otherAnimalsMale' => $otherAnimals->where('gender', GenderEnum::MALE()),
            'otherAnimalsFemale' => $otherAnimals->where('gender', GenderEnum::FEMALE()),
        ]);
    }

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

    public function edit(Litter $litter): View
    {
        return view('models.litter.edit', [
            'litter' => $litter
        ]);
    }

    public function update(Request $request, Litter $litter)
    {
        $this->authorize('update', $litter);
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
