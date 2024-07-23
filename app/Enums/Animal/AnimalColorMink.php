<?php

declare(strict_types=1);

namespace App\Enums\Animal;

enum AnimalColorMink: int
{
    case INDETERMINABLE = 3;
    case AMERICAN = 0;
    case BRITISH = 1;
    case AUSTRALIAN = 2;
}
