<?php

declare(strict_types=1);

namespace App\Enums\Animal;

use App\Traits\Enums\Arrayable;
use App\Traits\Enums\Localized;

enum AnimalPrimaryMarkEnum: int
{
    use Localized;
    use Arrayable;

    case INDETERMINABLE = 0;
    case SELF = 1;
    case AMERICAN_BERKSHIRE = 2;
    case BERKSHIRE = 3;
    case EYED_WHITE = 4;
    case DALMATIAN = 5;
    case ESSEX = 6;
    case BALDIE = 7;
    case IRISH = 8;
    case HOODED = 9;
    case BAREBACK = 10;
    case CAPPED = 11;
    case PATCHED = 12;
    case MASKED = 13;
    case COLLARED = 14;
    case BANDED = 15;
    case VARIEGATED = 16;
    case VARIEBERK = 17;
    case VAN = 18;
}
