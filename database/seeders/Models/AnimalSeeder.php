<?php

declare(strict_types=1);

namespace Database\Seeders\Models;

use App\Models\Animal;
use Illuminate\Database\Seeder;

class AnimalSeeder extends Seeder
{
    public function run(): void
    {
        Animal::factory()
            ->count(150)
            ->create();
    }
}
