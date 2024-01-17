<?php

declare(strict_types=1);

namespace App\Enums\Animal;

use App\Traits\Enums\Arrayable;
use App\Traits\Enums\Localized;

enum AnimalSecondaryMarkEnum: int
{
    use Localized;
    use Arrayable;

    case BLAZED = 1;
    case SPOTTED = 2;
}
