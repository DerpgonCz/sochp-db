<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Animal\AnimalBreedingTypeEnum;
use App\Enums\Animal\AnimalBuildEnum;
use App\Enums\Animal\AnimalColorFull;
use App\Enums\Animal\AnimalColorMink;
use App\Enums\Animal\AnimalColorShaded;
use App\Enums\Animal\AnimalEffectEnum;
use App\Enums\Animal\AnimalEyesEnum;
use App\Enums\Animal\AnimalFurEnum;
use App\Enums\Animal\AnimalPrimaryMarkEnum;
use App\Enums\Animal\AnimalSecondaryMarkEnum;
use App\Enums\GenderEnum;
use App\Models\Animal;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    public function definition(): array
    {
        $gender = $this->faker->randomElement([GenderEnum::MALE, GenderEnum::FEMALE]);

        $shadedColor = $this->faker->randomElement(AnimalColorShaded::cases());
        $fullColor = $this->faker->randomElement(AnimalColorFull::cases());
        $minkColor = in_array($fullColor, AnimalColorFull::MINK_COLORS) ? $this->faker->randomElement(AnimalColorMink::cases()) : null;

        [$shadedColor, $fullColor, $minkColor] = $this->faker->randomElement(
            [
                [$shadedColor, null, null],
                [null, $fullColor, null],
                [null, $fullColor, $minkColor],
                [$shadedColor, $fullColor, null]
            ]
        );

        return [
            'name' => sprintf('ANI %s', $this->faker->name($gender === GenderEnum::MALE ? 'male' : 'female')),
            'registration_no' => $this->faker->unique()->numerify('P ###/##'),
            'died_on' => $this->faker->optional(0.8)->dateTimeThisDecade(),
            'gender' => $gender,
            'fur' => $this->faker->randomElement(AnimalFurEnum::values()), // TODO: Choose multiple valid
            'build' => $this->faker->randomElement(AnimalBuildEnum::values()), // TODO: Choose multiple valid
            'color_shaded' => $shadedColor,
            'color_full' => $fullColor,
            'color_mink' => $minkColor,
            'effect' => $this->faker->randomElement(AnimalEffectEnum::values()),  // TODO: Choose multiple valid
            'mark_primary' => $this->faker->optional(0.75)->randomElement(AnimalPrimaryMarkEnum::values()),
            'mark_secondary' => $this->faker->optional(0.25)->randomElement(AnimalSecondaryMarkEnum::values()),
            'eyes' => $this->faker->randomElement(AnimalEyesEnum::values()),
            'breeding_type' => $this->faker->randomElement(AnimalBreedingTypeEnum::values()),
        ];
    }
}
