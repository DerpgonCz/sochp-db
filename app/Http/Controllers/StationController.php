<?php

namespace App\Http\Controllers;

use App\Enums\StationStateEnum;
use App\Facades\Flashes;
use App\Http\Requests\StationStoreRequest;
use App\Http\Requests\StationUpdateRequest;
use App\Models\Station;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class StationController extends Controller
{
    public function index(): View
    {
        return view('models.station.index', [
            'userStation' => Auth::check() ? Auth::user()->station : null,
            'stations' => Station::approved()->with('owner')->get(),
            'stationsForApproval' => Station::where('state', StationStateEnum::FOR_APPROVAL)->get(),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Station::class);

        return view('models.station.create');
    }

    public function store(StationStoreRequest $request)
    {
        $this->authorize('create', Station::class);

        $station = Station::make($request->validated());
        $station->state = StationStateEnum::DRAFT;
        $station->owner()->associate(Auth::user());
        $station->save();

        Flashes::success(__('flashes.stations.created'));

        return response()->redirectToRoute('stations.show', $station);
    }

    public function show(Station $station): View|RedirectResponse
    {
        $this->authorize('view', $station);

        if ($station->state->is(StationStateEnum::DRAFT)) {
            return response()->redirectToRoute('stations.edit', $station);
        }

        return view('models.station.show', ['station' => $station]);
    }

    public function edit(Station $station)
    {
        $this->authorize('update', $station);

        return view('models.station.edit', [
            'station' => $station,
        ]);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(StationUpdateRequest $request, Station $station)
    {
        $this->authorize('update', $station);

        $station->fill($request->validated());

        // State logic
        $redirect = ['stations.edit', $station];
        $flashMessage = 'flashes.stations.updated';
        if ($request->has('state')) {
            $toState = StationStateEnum::fromValue((int)$request->get('state'));
            $this->authorize('updateState', [$station, $toState]);

            $redirectTransitions = [
                StationStateEnum::FOR_APPROVAL => ['stations.show', $station],
                StationStateEnum::APPROVED => ['stations.show', $station],
                StationStateEnum::REQUIRES_CHANGES => ['stations.index'],
            ];
            $flashMessages = [
                StationStateEnum::FOR_APPROVAL => 'flashes.stations.state.for_approval',
                StationStateEnum::APPROVED => 'flashes.stations.state.approved',
                StationStateEnum::REQUIRES_CHANGES => 'flashes.stations.state.requires_changes',
            ];

            $station->state = $toState;

            $redirect = $redirectTransitions[$toState->value];
            $flashMessage = $flashMessages[$toState->value] ?: $flashMessage;
        }

        $station->save();

        Flashes::success(__($flashMessage));

        return response()->redirectToRoute(...$redirect);
    }

    public function destroy(Station $station): void
    {
        //
    }
}
