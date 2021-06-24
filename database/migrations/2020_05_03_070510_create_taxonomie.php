<?php

use Database\Seeders\TaxonomieSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomie extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!env('DB_MIGRATE_HLS')) {
            return;
        }

        Schema::create('hls.taxonomie', function (Blueprint $table) {
            $table->integer('id_taxonomie')->autoIncrement()->primary();
            $table->string('beschreibung');
            $table->text('erklaerung');
        });

        Artisan::call('db:seed', [
            '--class' => TaxonomieSeeder::class,
            '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hls.taxonomie');
    }
}
