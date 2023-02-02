<?php

declare(strict_types=1);

namespace App\Enums\Animal;

use App\Traits\Enums\Arrayable;
use App\Traits\Enums\Localized;

enum AnimalEffectEnum: int
{
    use Localized;
    use Arrayable;

    case FLAG_ROAN = 0b000001;
    case FLAG_MARBLE = 0b000010;
    case FLAG_MERLE = 0b000100;
    case FLAG_SILVERMANE = 0b001000;
    case FLAG_SILVERED = 0b010000;
    case FLAG_ODD_EYED = 0b100000;
}
