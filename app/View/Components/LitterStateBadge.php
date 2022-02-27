<?php

namespace App\View\Components;

use App\Models\Litter;
use Illuminate\View\Component;

class LitterStateBadge extends Component
{
    private Litter $litter;

    public function __construct(Litter $litter)
    {
        $this->litter = $litter;
    }

    public function render()
    {
        return view('components.litter-state-badge', [
            'value' => $this->litter->state->value,
        ]);
    }
}
