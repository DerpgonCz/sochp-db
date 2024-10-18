<?php

namespace App\Http\Controllers;

use App\Facades\Flashes;
use App\Http\Requests\AnimalCreateRequest;
use App\Http\Requests\AnimalUpdateRequest;
use App\Models\Animal;
use App\Models\Station;
use App\Models\User;
use App\Services\FileUploadService;
use App\Services\Frontend\Animal\AnimalColorBuilderValueSerializer;
use App\Services\Frontend\Animal\AnimalSelectDataService;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

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
    ): View {
        $this->authorize('create', Animal::class);

        return view(
            'models.animal.create',
            [
                ...$animalSelectDataService->buildViewDataForParentSelection(),
                'stations' => Station::all(),
                'today' => date('Y-m-d'),
            ]
        );
    }

    public function store(
        AnimalCreateRequest $request,
        FileUploadService $fileUploadService,
    ): RedirectResponse {
        $animalData = $request->get('animal');
        $deserializedColor = AnimalColorBuilderValueSerializer::deserialize($animalData['color']);

        $animal = Animal::create(
            [
                ...collect($animalData)->except(['id', 'color'])->toArray(),
                'color_shaded' => $deserializedColor['shaded'] ?? null,
                'color_full' => $deserializedColor['full'] ?? null,
                'color_mink' => $deserializedColor['mink'] ?? null,
            ]
        );

        $animal->file_pedigree_path = $fileUploadService->storeAnimalPedigree(1, $request->file('files.pedigree'));

        return response()->redirectToRoute('animals.show', ['animal' => $animal->id]);
    }

    public function show(Animal $animal): View
    {
        return view('models.animal.show', [
            'animal' => $animal->load(['caretaker', 'caretaker.station', 'litter']),
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
     * @throws AuthorizationException
     */
    public function destroy(Animal $animal): Response
    {
        $this->authorize('delete', $animal);

        $animal->delete();

        return response()->noContent();
    }

    # Files
    public function filePedigree(Animal $animal): Response|StreamedResponse
    {
        $filePath = $animal->file_pedigree_path;
        if ($filePath === null) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return Storage::download($filePath);
    }
}
