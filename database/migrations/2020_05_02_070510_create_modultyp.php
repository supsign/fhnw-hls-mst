<?php

use Database\Seeders\ModultypSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModultyp extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!env('DB_MIGRATE_HLS')) {
            return;
        }

        Schema::create('hls.modultyp', function (Blueprint $table) {
            $table->integer('id_modultyp')->autoIncrement()->primary();
            $table->string('bezeichnung');
        });

        Artisan::call('db:seed', [
            '--class' => ModultypSeeder::class,
            '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hls.modultyp');
    }
}
