<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Animal\AnimalBreedingTypeEnum;
use App\Enums\Animal\AnimalBuildEnum;
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

        return [
            'name' => sprintf('ANI %s', $this->faker->name($gender === GenderEnum::MALE ? 'male' : 'female')),
            'registration_no' => $this->faker->unique()->numerify('P ###/##'),
            'died_on' => $this->faker->optional(0.8)->dateTimeThisDecade(),
            'gender' => $gender,
            'fur' => $this->faker->randomElement(AnimalFurEnum::values()), // TODO: Choose multiple valid
            'build' => $this->faker->randomElement(AnimalBuildEnum::values()), // TODO: Choose multiple valid
            'color' => $this->faker->randomElement([
                '',
                'Ruská modrá (russian blue)',
                'Plavá (fawn)',
                'Černá (black)',
                'Skořicová perlová (cinnamon pearl)',
                'Ruská stříbrná (russian silver)',
                'Stříbřitá modrá (powder blue)',
                'Béžová (beige)',
                'Americká modrá (american blue)',
                'Topazová (topaz)',
                'Aguti (agouti)',
                'Jantarová (amber)',
                'Skořicová (cinnamon)',
                'Britský mink (british mink)',
                'Ruská perlová (russian pearl)',
                'Hnědé znaky (seal point)',
                'Platinová (platinum)',
                'Albín (albino)',
                'Stříbrná (silver)',
                'Americký mink (american mink)',
                'Ruská modrá aguti (russian blue agouti)',
                'Šampaňská (champagne)',
                'Perlová (pearl)',
                'Platinová aguti (platinum agouti)',
                'Buvolí (buff)',
                'Modrá aguti (blue agouti)',
                'Holubičí (russian dove)',
                'Havanská aguti (havana agouti)',
                'Ruská stříbrná aguti (russian silver agouti)',
                'Holubičí aguti (russian dove agouti)',
                'Čokoládová (chocolate)',
                'Jiná (other)',
                'Kávová (coffee)',
                'Tmavá perlová (dark pearl)',
                'Lila (lilac)',
                'Perlová platina (platinum pearl)',
                'Slonovinová (ivory, (milk / BE) cream)',
                'Havanská (havana)',
                'Kakaová (cocoa)',
                'Ruská perlová aguti (russian pearl ag.)',
                'Čokoládová aguti (chocolate agouti)',
                'Karamelová (caramel)',
                'Lila aguti (lilac agouti)',
                'Double mink (double mink)',
                'Ruská platina (russian platinum)',
            ]),
            'effect' => $this->faker->randomElement(AnimalEffectEnum::values()),
            'mark_primary' => $this->faker->optional(0.75)->randomElement(AnimalPrimaryMarkEnum::values()),
            'mark_secondary' => $this->faker->optional(0.25)->randomElement(AnimalSecondaryMarkEnum::values()),
            'eyes' => $this->faker->randomElement(AnimalEyesEnum::values()),
            'breeding_type' => $this->faker->randomElement(AnimalBreedingTypeEnum::values()),
        ];
    }
}
