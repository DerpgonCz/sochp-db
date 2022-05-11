<?php

namespace App\View\Components;

use App\Models\Litter;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LitterStateBadge extends Component
{
    private Litter $litter;

    public function __construct(Litter $litter)
    {
        $this->litter = $litter;
    }

    public function render(): View
    {
        return view('components.litter-state-badge', [
            'value' => $this->litter->state->value,
        ]);
    }
}
