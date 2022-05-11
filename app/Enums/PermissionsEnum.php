<?php

declare(strict_types=1);

namespace App\Enums;

enum PermissionsEnum: string
{
    case MANAGE_STATIONS = 'manage stations';
    case MANAGE_LITTERS = 'manage litters';
}
