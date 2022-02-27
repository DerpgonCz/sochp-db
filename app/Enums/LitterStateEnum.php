<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

class LitterStateEnum extends Enum implements LocalizedEnum
{
    public const DRAFT = 0;
    public const REQUIRES_DRAFT_CHANGES = 1;
    public const REQUIRES_BREEDING_APPROVAL = 2;
    public const BREEDING = 3;
    public const REQUIRES_BREEDING_CHANGES = 4;
    public const REQUIRES_FINAL_APPROVAL = 5;
    public const APPROVED = 6;
}
