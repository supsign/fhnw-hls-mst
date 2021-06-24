<?php

use Database\Seeders\ModulSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModul extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!env('DB_MIGRATE_HLS')) {
            return;
        }

        Schema::create('hls.modul', function (Blueprint $table) {
            $table->string('laufnummer')->primary();
            $table->string('modulbezeichnung');
            $table->string('kuerzel', 6)->nullable();
            $table->string('semester')->nullable();
            $table->integer('modulnummer')->nullable();
            $table->smallInteger('kreditpunkte')->nullable();
            $table->foreignId('id_sprache')->nullable()->constrained('hls.sprache', 'id_sprache');
            $table->foreignId('id_modultyp')->nullable()->constrained('hls.modultyp', 'id_modultyp');
        });

        Artisan::call('db:seed', [
            '--class' => ModulSeeder::class,
            '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hls.modul');
    }
}
