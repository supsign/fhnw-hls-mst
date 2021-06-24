<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulgruppe extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!env('DB_MIGRATE_HLS')) {
            return;
        }

        Schema::create('hls.modulgruppe', function (Blueprint $table) {
            $table->integer('id_modulgruppe')->autoIncrement()->primary();
            $table->string('modulgruppenbezeichnung');
            $table->text('beschreibung');
            $table->boolean('neu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hls.modulgruppe');
    }
}
