<?php

use Database\Seeders\StudienrichtungSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudienrichtung extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!env('DB_MIGRATE_HLS')) {
            return;
        }

        Schema::create('hls.studienrichtung', function (Blueprint $table) {
            $table->integer('id_studienrichtung')->autoIncrement()->primary();
            $table->string('bezeichnung')->nullable();
            $table->foreignId('id_studiengang')->constrained('hls.studiengang', 'id_studiengang');
            $table->integer('personalnummer')->nullable();
            $table->string('kuerzel', 6)->nullable();
            $table->boolean('neu')->default(false);
        });

        Artisan::call('db:seed', [
            '--class' => StudienrichtungSeeder::class,
            '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hls.studienrichtung');
    }
}
