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
            $table->string('breeder_name')->nullable();
            $table->string('registration_no')->unique()->nullable();
            $table->text('note')->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->dateTime('died_on')->nullable();
            $table->boolean('mark_down_under')->default(false);
            $table->boolean('non_standard')->default(false);

            // Flag enums
            $table->unsignedSmallInteger('fur');
            $table->unsignedTinyInteger('build');
            $table->integer('color_full')->nullable();
            $table->integer('color_shaded')->nullable();
            $table->integer('color_mink')->nullable();

            // Single value enums
            $table->unsignedTinyInteger('breeding_type')->nullable();
            $table->unsignedTinyInteger('effect')->nullable();
            $table->unsignedTinyInteger('mark_primary')->nullable();
            $table->unsignedTinyInteger('mark_secondary')->nullable();
            $table->unsignedTinyInteger('gender');
            $table->unsignedTinyInteger('eyes');
            $table->unsignedTinyInteger('color_pearl')->nullable();

            $table->foreignId('caretaker_id')->nullable()->constrained('users');
        });
    }
};
