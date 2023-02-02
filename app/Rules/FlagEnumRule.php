<?php

declare(strict_types=1);

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FlagEnumRule implements Rule
{
    /** @var string */
    private string $classEnum;

    /**
     * @param class-string $classEnum
     */
    public function __construct(string $classEnum)
    {
        assert(enum_exists($classEnum));
        $this->classEnum = $classEnum;
    }

    public function passes($attribute, $value): bool
    {
        $value = (int)$value;
        foreach ($this->classEnum::selectableGroups() as $group) {
            $groupAggregate = 0;
            foreach ($group as $flag) {
                $groupAggregate |= $flag->value;
            }

            if (($groupAggregate & $value) === $value) {
                return true;
            }
        }

        return false;
    }

    public function message(): string|array
    {
        return 'The validation error message.';
    }
}
