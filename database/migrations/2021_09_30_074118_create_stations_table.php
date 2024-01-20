<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('stations', function (Blueprint $table): void {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('breeder_name')->nullable();
            $table->boolean('name_is_prefix')->default(true);
            $table->string('name_part')->default('');
            $table->unsignedTinyInteger('state');

            $table->foreignId('owner_id')->nullable()->constrained('users');
        });
    }
};
