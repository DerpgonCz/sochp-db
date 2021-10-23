<?php

namespace App\Http\Controllers;

use App\Models\Litter;
use Illuminate\Http\Request;
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
            'litters' => Litter::orderByDesc('happened_on')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function show(Litter $litter): View
    {
        return view('models.litter.show', [
            'litter' => $litter->load(['mother', 'father']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Litter $litter
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Litter $litter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Litter $litter
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Litter $litter)
    {
        //
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
