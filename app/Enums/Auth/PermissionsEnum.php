<?php

declare(strict_types=1);

namespace App\Enums\Auth;

enum PermissionsEnum: string
{
    case MANAGE_STATIONS = 'manage stations';
    case MANAGE_LITTERS = 'manage litters';
    case MANAGE_ANIMALS = 'manage animals';
}
