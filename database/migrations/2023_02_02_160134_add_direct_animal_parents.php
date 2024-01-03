<?php

declare(strict_types=1);

use App\Models\Animal;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration
{
    public function up(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->foreignId('mother_id')->nullable()->constrained('animals');
            $table->foreignId('father_id')->nullable()->constrained('animals');
        });

        foreach (Animal::with('litter')->get() as $animal) {
            $animal->update(
                [
                    'mother_id' => $animal->litter->mother->id,
                    'father_id' => $animal->litter->father->id,
                ]
            );
        }
    }
};
