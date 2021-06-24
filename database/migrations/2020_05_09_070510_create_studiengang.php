<?php

use Database\Seeders\StudiengangSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudiengang extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!env('DB_MIGRATE_HLS')) {
            return;
        }

        Schema::create('hls.studiengang', function (Blueprint $table) {
            $table->integer('id_studiengang')->autoIncrement()->primary();
            $table->string('bezeichnung')->nullable();
            $table->foreignId('id_stufe')->constrained('hls.stufe', 'id_stufe');
            $table->integer('personalnummer')->nullable();
            $table->string('kuerzel', 6)->nullable();
            $table->boolean('neu')->default(false);
        });

        Artisan::call('db:seed', [
            '--class' => StudiengangSeeder::class,
            '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hls.studiengang');
    }
}
