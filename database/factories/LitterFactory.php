<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\LitterStateEnum;
use App\Models\Litter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LitterFactory extends Factory
{
    protected $model = Litter::class;

    public function definition(): array
    {
        return [
            'name' => sprintf('LTR %s', Str::upper($this->faker->unique()->bothify('??####'))),
            'registration_no' => $this->faker->unique()->numerify('P ###/##'),
            'state' => LitterStateEnum::getRandomInstance(),
            'happened_on' => $this->faker->dateTimeThisDecade(),
        ];
    }
}
