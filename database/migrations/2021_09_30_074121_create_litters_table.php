<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('litters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->date('happened_on')->nullable();
            $table->string('name');

            $table->foreignId('mother_id')->nullable()->constrained('animals');
            $table->foreignId('father_id')->nullable()->constrained('animals');
            $table->foreignId('station_id')->nullable()->constrained('stations');
        });

        Schema::table('animals', function (Blueprint $table): void {
            $table->foreignId('litter_id')->nullable()->constrained('litters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('animals', function (Blueprint $table): void {
            $table->dropForeign('litter_id');
        });
        Schema::dropIfExists('litters');
    }
};
