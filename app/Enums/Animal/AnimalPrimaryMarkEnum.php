<?php

declare(strict_types=1);

namespace App\Enums\Animal;

use App\Traits\Enums\Arrayable;
use App\Traits\Enums\Localized;

enum AnimalPrimaryMarkEnum: int
{
    use Localized;
    use Arrayable;

    case AMERICAN_BERKSHIRE = 1;
    case BERKSHIRE_DOWN_UNDER = 2;
    case HOODED_DOWN_UNDER = 3;
    case BANDED_DOWN_UNDER = 4;
    case VARIEGATED_DOWN_UNDER = 5;
    case VARIEBERK_DOWN_UNDER = 6;
    case BERKSHIRE = 7;
    case self = 8;
    case EYED_WHITE = 9;
    case DALMATIAN = 10;
    case ESSEX = 11;
    case BALDIE = 12;
    case IRISH = 13;
    case HOODED = 14;
    case MISMARKED = 15;
    case BAREBACK = 16;
    case CAPPED = 17;
    case PATCHED = 18;
    case MASKED = 19;
    case COLLARED = 20;
    case BANDED = 21;
    case VARIEGATED = 22;
    case VARIEBERK = 23;
    case VAN = 24;
}
