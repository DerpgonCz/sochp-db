<?php

namespace App\View\Components;

use App\Models\Station;
use Illuminate\View\Component;

class StationStateBadge extends Component
{
    private Station $station;

    public function __construct(Station $station)
    {
        $this->station = $station;
    }

    public function render()
    {
        return view('components.station-state-badge', [
            'value' => $this->station->state->value,
        ]);
    }
}
