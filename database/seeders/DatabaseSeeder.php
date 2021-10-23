<?php

declare(strict_types=1);

namespace Database\Seeders;

use Database\Seeders\Models\AnimalSeeder;
use Database\Seeders\Models\LitterSeeder;
use Database\Seeders\Models\StationSeeder;
use Database\Seeders\Models\UserSeeder;
use Database\Seeders\Relationships\AnimalCaretakerRelationshipSeeder;
use Database\Seeders\Relationships\AnimalLitterRelationshipSeeder;
use Database\Seeders\Relationships\AnimalStationRelationshipSeeder;
use Database\Seeders\Relationships\LitterStationRelationshipSeeder;
use Database\Seeders\Relationships\UserStationRelationshipSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            StationSeeder::class,
            AnimalSeeder::class,
            LitterSeeder::class,

            AnimalLitterRelationshipSeeder::class,
            AnimalCaretakerRelationshipSeeder::class,
            UserStationRelationshipSeeder::class,
            LitterStationRelationshipSeeder::class,
        ]);
    }
}
