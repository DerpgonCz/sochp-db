<?php

declare(strict_types=1);

namespace Database\Seeders\Relationships;

use App\Enums\StationStateEnum;
use App\Models\Litter;
use App\Models\Station;
use Illuminate\Database\Seeder;

class LitterStationRelationshipSeeder extends Seeder
{
    public function run(): void
    {
        $stations = Station::all();
        $litters = Litter::all();

        foreach ($litters as $litter) {
            $stationsToSearch = $stations;
            if ($litter->state->is(StationStateEnum::APPROVED)) {
                // Limit search space to only approved stations for approved litters
                $stationsToSearch = $stations->where('state', StationStateEnum::APPROVED());
            }

            $station = $stationsToSearch->random();
            if (!$station) {
                // FIXME: What to do when no approved station found
                continue;
            }

            $litter->station()->associate($station)->save();
        }
    }
}
