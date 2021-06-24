<?php

use Database\Seeders\AddStufeSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStufe extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!env('DB_MIGRATE_HLS')) {
            return;
        }

        Schema::create('hls.stufe', function (Blueprint $table) {
            $table->id('id_stufe');
            $table->string('stufe');
            $table->char('kuerzel', 1)->nullable();
        });

        Artisan::call('db:seed', [
            '--class' => AddStufeSeeder::class,
            '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('hls.stufe');
    }
}
