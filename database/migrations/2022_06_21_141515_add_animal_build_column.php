<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('animals', static function (Blueprint $table): void {
            $table->unsignedTinyInteger('build')->default(0b0001);
        });
    }

    public function down(): void
    {
        Schema::table('animals', static function (Blueprint $table): void {
            $table->dropColumn('build');
        });
    }
};
