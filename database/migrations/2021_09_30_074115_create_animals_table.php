<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name')->nullable();
            $table->string('registration_no')->unique()->nullable();
            $table->string('fur')->nullable();
            $table->string('color')->nullable();
            $table->string('effect')->nullable();
            $table->string('mark_primary')->nullable();
            $table->string('mark_secondary')->nullable();
            $table->text('note')->nullable();
            $table->tinyInteger('gender')->default(0);
            $table->dateTime('died_on')->nullable();

            $table->foreignId('caretaker_id')->nullable()->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
