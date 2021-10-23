<?php

declare(strict_types=1);

namespace Database\Seeders\Relationships;

use App\Models\Animal;
use App\Models\Station;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserStationRelationshipSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $stations = Station::all();

        foreach ($stations as $station) {
            $station->owner()->associate($users->random())->save();
        }
    }
}
