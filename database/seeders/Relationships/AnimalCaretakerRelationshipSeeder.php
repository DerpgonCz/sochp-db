<?php

declare(strict_types=1);

namespace Database\Seeders\Relationships;

use App\Models\Animal;
use App\Models\Station;
use App\Models\User;
use Illuminate\Database\Seeder;

class AnimalCaretakerRelationshipSeeder extends Seeder
{
    public function run(): void
    {
        $animals = Animal::all();
        $users = User::all();

        foreach ($animals as $animal) {
            $animal->caretaker()->associate($users->random())->save();
        }
    }
}
