<?php

declare(strict_types=1);

namespace Database\Seeders\Models;

use App\Models\Station;
use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    public function run(): void
    {
        Station::factory()
            ->count(20)
            ->create();
    }
}
