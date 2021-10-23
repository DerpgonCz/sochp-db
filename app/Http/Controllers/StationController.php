<?php

namespace App\Http\Controllers;

use App\Enums\StationStateEnum;
use App\Facades\Flashes;
use App\Http\Requests\StationStoreRequest;
use App\Http\Requests\StationUpdateRequest;
use App\Models\Station;
use http\Exception\UnexpectedValueException;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class StationController extends Controller
{
    public const SHOW_FIELDS = [
        'name',
        'state',
    ];

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

        $redirect = ['stations.edit', $station];
        $flashMessage = 'flashes.stations.updated';
        if ($request->has('state')) {
            $allowedTransitions = [
                StationStateEnum::DRAFT => [StationStateEnum::FOR_APPROVAL],
                StationStateEnum::FOR_APPROVAL => [StationStateEnum::APPROVED, StationStateEnum::REQUIRES_CHANGES],
                StationStateEnum::APPROVED => [],
                StationStateEnum::REQUIRES_CHANGES => [StationStateEnum::FOR_APPROVAL],
            ];
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

            $fromState = $station->state->value;
            $toState = (int)$request->get('state');
            if (!in_array($toState, $allowedTransitions[$fromState], true)) {
                throw new UnexpectedValueException('Invalid state transfer');
            }
            $station->state = StationStateEnum::fromValue($toState);

            $redirect = $redirectTransitions[$toState];
            $flashMessage = $flashMessages[$toState] ?: $flashMessage;
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
