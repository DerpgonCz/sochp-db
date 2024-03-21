<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('animals', function (Blueprint $table) {
            $table->string('breeder_station_name')->nullable();
            $table->string('caretaker_name')->nullable();
            $table->string('caretaker_station_name')->nullable();

            $table->foreignId('owner_id')->nullable()->constrained('users');
        });

        Schema::table('litters', function (Blueprint $table) {
            $table->string('breeder_name')->nullable();
            $table->string('breeder_station_name')->nullable();
        });
    }
};
