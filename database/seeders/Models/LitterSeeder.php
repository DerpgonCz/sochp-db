<?php

declare(strict_types=1);

namespace Database\Seeders\Models;

use App\Enums\LitterStateEnum;
use App\Models\Litter;
use Illuminate\Database\Seeder;

class LitterSeeder extends Seeder
{
    public function run(): void
    {
        foreach (LitterStateEnum::getValues() as $litterState) {
            Litter::factory()
                ->count(10)
                ->create([
                    'state' => $litterState,
                ]);
        }
    }
}
