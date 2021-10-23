<?php

declare(strict_types=1);

namespace Database\Seeders\Models;

use App\Models\Litter;
use Illuminate\Database\Seeder;

class LitterSeeder extends Seeder
{
    public function run(): void
    {
        Litter::factory()
            ->count(50)
            ->create();
    }
}
