<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStateToLitters extends Migration
{
    public function up(): void
    {
        Schema::table('litters', function (Blueprint $table) {
            $table->unsignedTinyInteger('state');
        });
    }

    public function down(): void
    {
        Schema::table('litters', function (Blueprint $table) {
            $table->dropColumn('state');
        });
    }
}
