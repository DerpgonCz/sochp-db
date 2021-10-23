<?php

declare(strict_types=1);

namespace Database\Seeders\Relationships;

use App\Models\Animal;
use App\Models\Litter;
use App\Models\Station;
use App\Models\User;
use Illuminate\Database\Seeder;

class LitterStationRelationshipSeeder extends Seeder
{
    public function run(): void
    {
        $stations = Station::all();
        $litters = Litter::all();

        foreach ($litters as $litter) {
            $litter->station()->associate($stations->random())->save();
        }
    }
}
