<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

class StationStateEnum extends Enum implements LocalizedEnum
{
    public const DRAFT = 0;
    public const FOR_APPROVAL = 1;
    public const APPROVED = 2;
    public const REQUIRES_CHANGES = 3;
}
