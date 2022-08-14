<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnimalController extends Controller
{
    public function index(): View
    {
        return view('models.animal.index', ['animals' => Animal::all()]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Animal $animal): View
    {
        return view('models.animal.show', [
            'animal' => $animal->load(['owner', 'owner.owner', 'litter']),
        ]);
    }

    public function edit(Animal $animal)
    {
        //
    }

    public function update(Request $request, Animal $animal)
    {
        //
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
