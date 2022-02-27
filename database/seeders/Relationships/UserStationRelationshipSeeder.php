<?php

declare(strict_types=1);

namespace Database\Seeders\Relationships;

use App\Models\Station;
use App\Models\User;
use Illuminate\Database\Seeder;
use Webmozart\Assert\Assert;

class UserStationRelationshipSeeder extends Seeder
{
    public function run(): void
    {
        Assert::greaterThanEq(User::count(), Station::count(), 'User count (%s) should be greater or equal to count of Stations (%s)');

        foreach (Station::all() as $station) {

            $user = User::whereDoesntHave('station')->inRandomOrder()->first();
            $station->owner()->associate($user)->save();
        }
    }
}
