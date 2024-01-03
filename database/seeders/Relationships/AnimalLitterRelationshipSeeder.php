<?php

declare(strict_types=1);

namespace Database\Seeders\Relationships;

use App\Models\Animal;
use App\Models\Litter;
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
            $litter->father()->associate($males->random());
            $litter->mother()->associate($females->random());
            $litter->save();
        }
    }

    private function associateChildren(Collection$litters): void
    {
        $children = Animal::all();

        foreach ($children as $child) {
            /** @var Animal $child */
            $litter = $litters->random();
            $child->litter()->associate($litter);
            $child->mother()->associate($litter->mother);
            $child->father()->associate($litter->father);
            $child->save();
        }
    }
}
