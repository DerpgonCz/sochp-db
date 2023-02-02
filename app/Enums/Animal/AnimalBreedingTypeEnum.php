<?php

declare(strict_types=1);

namespace App\Enums\Animal;

use App\Traits\Enums\Arrayable;
use App\Traits\Enums\Localized;

enum AnimalBreedingTypeEnum: int
{
    use Localized;
    use Arrayable;

    case BREEDABLE_I = 1;
    case BREEDABLE_II = 2;
    case BREDDABLE_WITH_EXCEPTION = 3;
    case NOT_BREEDABLE = 4;
    case UNBREEDABLE = 5;
}
