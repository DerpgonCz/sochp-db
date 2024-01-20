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

    /**
     * @param Collection<Litter> $litters
     */
    private function associateParents(Collection $litters): void
    {
        $males = Animal::listable()->males()->get();
        $females = Animal::listable()->females()->get();

        foreach ($litters as $litter) {
            $litter->father()->associate($males->random());
            $litter->mother()->associate($females->random());
            $litter->save();
        }
    }

    /**
     * @param Collection<Litter> $litters
     */
    private function associateChildren(Collection $litters): void
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
