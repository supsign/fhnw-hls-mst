<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropHls extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!env('DB_MIGRATE_HLS')) {
            return;
        }

        Schema::dropIfExists('hls.modulgruppe_zu_studienrichtung');
        Schema::dropIfExists('hls.studienrichtung');
        Schema::dropIfExists('hls.studiengang');
        Schema::dropIfExists('hls.stufe');
        Schema::dropIfExists('hls.modul_zu_modulgruppe');
        Schema::dropIfExists('hls.modulgruppe');
        Schema::dropIfExists('hls.lernziel');
        Schema::dropIfExists('hls.modul');
        Schema::dropIfExists('hls.taxonomie');
        Schema::dropIfExists('hls.modultyp');
        Schema::dropIfExists('hls.sprache');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hls.sprache');
    }
}
