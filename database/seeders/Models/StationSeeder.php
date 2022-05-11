<?php

declare(strict_types=1);

namespace Database\Seeders\Models;

use App\Enums\StationStateEnum;
use App\Models\Station;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    public function run(): void
    {
        foreach (StationStateEnum::getValues() as $stationState) {
            Station::factory()
                ->count(5)
                ->create([
                    'state' => $stationState,
                ]);
        }
    }
}
