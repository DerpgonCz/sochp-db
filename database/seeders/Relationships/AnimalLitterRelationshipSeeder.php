<?php

declare(strict_types=1);

namespace Database\Seeders\Relationships;

use App\Models\Animal;
use App\Models\Litter;
use App\Models\Station;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;

class AnimalLitterRelationshipSeeder extends Seeder
{
    public function run(): void
    {
        $litters = Litter::all();

        $this->associateParents($litters);
        $this->associateChildren($litters);
    }

    private function associateParents(Collection $litters): void
    {
        $males = Animal::males()->get();
        $females = Animal::females()->get();

        foreach ($litters as $litter) {
            $litter->father()->associate($males->random())->save();
            $litter->mother()->associate($females->random())->save();
        }
    }

    private function associateChildren(Collection$litters): void
    {
        $children = Animal::all();

        foreach ($children as $child) {
            $child->litter()->associate($litters->random())->save();
        }
    }
}
