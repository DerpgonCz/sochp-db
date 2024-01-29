<?php

namespace App\Http\Controllers;

use App\Facades\Flashes;
use App\Http\Requests\AnimalUpdateRequest;
use App\Models\Animal;
use App\Models\User;
use App\Services\Frontend\Animal\AnimalColorBuilderValueSerializer;
use App\Services\Frontend\Animal\AnimalSelectDataService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnimalController extends Controller
{
    public function index(): View
    {
        return view(
            'models.animal.index',
            [
                'animals' => Animal::listable()->with('litter', 'litter.station')
                    ->orderBy(
                        DB::raw(
                            'GREATEST(animals.date_of_birth, (SELECT litters.happened_on FROM litters WHERE litters.id = animals.litter_id))'
                        ),
                        'desc'
                    )
                    ->paginate(50),
            ]
        );
    }

    public function create(
        AnimalSelectDataService $animalSelectDataService,
    ): View
    {
        return view(
            'models.animal.create',
            [
                ...$animalSelectDataService->buildViewDataForParentSelection(Auth::user()?->station),
            ]
        );
    }

    public function store(Request $request)
    {
        $animal = $request->get('animal');
        $deserializedColor = AnimalColorBuilderValueSerializer::deserialize($animal['color']);
        Animal::updateOrCreate(
            ['id' => $animal['id'] ?? null],
            [
                ...collect($animal)->except(['id', 'color'])->toArray(),
                'color_shaded' => $deserializedColor['shaded'],
                'color_full' => $deserializedColor['full'],
                'color_mink' => $deserializedColor['mink'],
                // 'litter_id' => $litter->id,
                // 'mother_id' => $litter->mother_id,
                // 'father_id' => $litter->father_id,
            ]
        );
    }

    public function show(Animal $animal): View
    {
        return view('models.animal.show', [
            'animal' => $animal->load(['owner', 'owner.owner', 'litter']),
        ]);
    }

    public function edit(Animal $animal): View
    {
        return view('models.animal.edit', [
            'animal' => $animal,
            'caretakers' => User::all(),
        ]);
    }

    public function update(AnimalUpdateRequest $request, Animal $animal)
    {
        $this->authorize('update', $animal);

        $animal->update($request->validated());

        Flashes::success(__('flashes.animals.updated'));

        return response()->redirectToRoute('animals.show', $animal);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Animal $animal): Response
    {
        $this->authorize('delete', $animal);

        $animal->delete();

        return response()->noContent();
    }
}
