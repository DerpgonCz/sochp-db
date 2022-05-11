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
        Schema::create('stations', function (Blueprint $table): void {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->unsignedTinyInteger('state');

            $table->foreignId('owner_id')->nullable()->constrained('users');
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
            $table->dropForeign('owner_id');
        });

        Schema::dropIfExists('stations');
    }
};
