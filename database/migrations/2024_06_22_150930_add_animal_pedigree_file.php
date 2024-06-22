<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::table('animals', static function (Blueprint $blueprint) {
            $blueprint->string('file_pedigree_path')->nullable()->default(null);
        });
    }
};
