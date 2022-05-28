<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\StationStateEnum;
use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\Factory;

class StationFactory extends Factory
{
    protected $model = Station::class;

    public function definition(): array
    {
        return [
            'name' => sprintf('ChS %s', $this->faker->name),
            'state' => StationStateEnum::getRandomInstance(),
        ];
    }
}
