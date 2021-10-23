<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

class GenderEnum extends Enum implements LocalizedEnum
{
    public const NOT_KNOWN = 0;
    public const MALE = 1;
    public const FEMALE = 2;
    public const NOT_APPLICABLE = 9;
}
