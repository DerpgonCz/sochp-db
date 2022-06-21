<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stations', function (Blueprint $table): void {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->unsignedTinyInteger('state');

            $table->foreignId('owner_id')->nullable()->constrained('users');
        });
    }

    public function down(): void
    {
        Schema::table('animals', function (Blueprint $table): void {
            $table->dropForeign('owner_id');
        });

        Schema::dropIfExists('stations');
    }
};
