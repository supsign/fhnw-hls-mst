<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModulgruppeZuStudienrichtung extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!env('DB_MIGRATE_HLS')) {
            return;
        }

        Schema::create('hls.modulgruppe_zu_studienrichtung', function (Blueprint $table) {
            $table->foreignId('id_modulgruppe')->constrained('hls.modulgruppe', 'id_modulgruppe');
            $table->foreignId('id_studienrichtung')->constrained('hls.studienrichtung', 'id_studienrichtung');
            $table->primary(['id_modulgruppe', 'id_studienrichtung']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hls.modulgruppe_zu_studienrichtung');
    }
}
