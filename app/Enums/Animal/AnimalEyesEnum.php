<?php

declare(strict_types=1);

namespace App\Enums\Animal;

use App\Traits\Enums\Arrayable;
use App\Traits\Enums\Localized;

enum AnimalEyesEnum: int
{
    use Localized;
    use Arrayable;

    case PINK = 1;
    case RED = 2;
    case RUBY = 3;
    case DARK_RUBY = 4;
    case BROWN = 5;
    case BLACK = 6;
}
