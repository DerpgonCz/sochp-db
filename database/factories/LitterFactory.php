<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Litter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LitterFactory extends Factory
{
    protected string $model = Litter::class;

    public function definition(): array
    {
        return [
            'name' => Str::upper($this->faker->randomLetter) . $this->faker->randomDigit,
            'happened_on' => $this->faker->dateTimeThisDecade(),
        ];
    }
}
