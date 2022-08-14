<?php

declare(strict_types=1);

namespace App\Enums\Animal;

use App\Traits\Enums\Arrayable;
use App\Traits\Enums\Localized;

enum AnimalEffectEnum: int
{
    use Localized;
    use Arrayable;

    case ROAN = 1;
    case MARBLE = 2;
    case MERLE = 3;
    case SILVERMANE = 4;
    case SILVERED = 5;
    case ODD_EYED = 6;
}
