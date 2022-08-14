<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->nullable();
            $table->string('registration_no')->unique()->nullable();
            $table->text('note')->nullable();
            $table->dateTime('died_on')->nullable();

            // Flag enums
            $table->unsignedTinyInteger('fur');
            $table->unsignedTinyInteger('build');
            $table->string('color')->nullable();

            // Single value enums
            $table->unsignedTinyInteger('breeding_type')->nullable();
            $table->unsignedTinyInteger('effect')->nullable();
            $table->unsignedTinyInteger('mark_primary')->nullable();
            $table->unsignedTinyInteger('mark_secondary')->nullable();
            $table->unsignedTinyInteger('gender');
            $table->unsignedTinyInteger('eyes');

            $table->foreignId('caretaker_id')->nullable()->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
