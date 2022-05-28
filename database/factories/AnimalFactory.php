<?php

declare(strict_types=1);

namespace Database\Factories;

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
            'name' => $this->faker->name($gender === GenderEnum::MALE ? 'male' : 'female'),
            'registration_no' => $this->faker->unique()->numerify('P ###/##'),
            'died_on' => $this->faker->optional(0.8)->dateTimeThisDecade(),
            'gender' => $gender,
            'fur' => $this->faker->randomElement(
                [
                    '',
                    'Rex (rex)',
                    'Standardní (standard)',
                    'Fuzz (fuzz)',
                    'Fuzz saténový (fuzz satin)',
                    'Velvetýn (velveteen)',
                    'Dvojitý rex (double-rex)',
                    'Dlouhosrstý (longhaired)',
                    'Saténový (satin)',
                    'Dvojitý velvetýn (double-velv.)',
                ]
            ),
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
            'effect' => $this->faker->randomElement([
                '',
                'Černooká siamská s barevnými znaky (coulour point BES)',
                'Barmská (burmese)',
                'Červenooká kuní (red eyed devil / marten)',
                'Siamská s barevnými znaky (colour point siamese)',
                'Himálajská s barevnými znaky (colour point himalayan)',
                'Barmská aguti (wheaten burmese)',
                'Černooká himálajská s bar.znaky (BE colour point himalayan)',
                'Postříbřená (silvered)',
                'Černooká kuní (black eyed devil / marten)',
                'Sobolí (sable burmese)',
                'Černooká kuní aguti (black eyed devil agouti)',
                'Himálajská zlatá (golden himalayan)',
                'Mramorovaná (merle)',
                'Červenooká kuní aguti (red eyed devil agouti)',
            ]),
            'mark_primary' => $this->faker->optional(0.75, '')->randomElement([
                'Bez bílé kresby (solid / self)',
                'Strakovaná berkšírská (varieberk)',
                'Americká (american berkshire)',
                'Japonská (hooded)',
                'Berkšírská (berkshire)',
                'Husky (husky / roan)',
                'Se širokým pruhem (banded)',
                'Strakovaná (variegated)',
                'S lysinou (blazed)',
                'Australská (berkshire down under)',
                'S bílými zády (bareback)',
                'Irská (irish)',
                'S maskou (masked)',
                'S čepicí (capped)',
                'Australská strakovaná berk. (varieberk D-U)',
                'Bílá černooká (BEW, black eyed white)',
                'Essex',
                'S hvězdou (spotted)',
                'Australská s pruhem (hooded down under)',
                'Australská strakovaná (variegated D-U)',
                'S flíčkem (patched)',
                'Australská se širokým pruhem (banded D-U)',
            ]),
            'mark_secondary' => $this->faker->optional(0.25, '')->randomElement([
                'S hvězdou (spotted)',
                'S lysinou (blazed)',
                'Husky (husky / roan)',
                'Nestandardní',
            ]),
        ];
    }
}
