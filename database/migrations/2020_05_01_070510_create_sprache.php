<?php

use Database\Seeders\SpracheSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSprache extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!env('DB_MIGRATE_HLS')) {
            return;
        }

        Schema::create('hls.sprache', function (Blueprint $table) {
            $table->integer('id_sprache')->autoIncrement()->primary();
            $table->string('sprache');
        });

        Artisan::call('db:seed', [
            '--class' => SpracheSeeder::class,
            '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hls.sprache');
    }
}
