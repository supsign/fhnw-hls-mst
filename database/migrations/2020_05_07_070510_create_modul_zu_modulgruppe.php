<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulZuModulgruppe extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!env('DB_MIGRATE_HLS')) {
            return;
        }

        Schema::create('hls.modul_zu_modulgruppe', function (Blueprint $table) {
            $table->foreignId('id_modulgruppe')->constrained('hls.modulgruppe', 'id_modulgruppe')->nullable(false);
            $table->string('laufnummer');
            $table->foreign('laufnummer')->references('laufnummer')->on('hls.modul');
            $table->primary(['id_modulgruppe', 'laufnummer']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hls.modul_zu_modulgruppe');
    }
}
