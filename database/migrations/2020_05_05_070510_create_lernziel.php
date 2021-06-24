<?php

use Database\Seeders\LernzielSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLernziel extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!env('DB_MIGRATE_HLS')) {
            return;
        }

        Schema::create('hls.lernziel', function (Blueprint $table) {
            $table->string('laufnummer');
            $table->smallInteger('nummer');
            $table->foreignId('id_taxonomie')->constrained('hls.taxonomie', 'id_taxonomie');
            $table->text('lernziel');
            $table->primary(['laufnummer', 'nummer']);
            $table->foreign('laufnummer')->references('laufnummer')->on('hls.modul');
        });

        Artisan::call('db:seed', [
            '--class' => LernzielSeeder::class,
            '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hls.lernziel');
    }
}
