<?php

use Database\Seeders\MentorSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMentorStudyfieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mentor_study_field', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained();
            $table->foreignId('study_field_id')->constrained();
            $table->boolean('is_deputy')->default(false);
            $table->timestamps();
        });

        Artisan::call('db:seed', [
            '--class' => MentorSeeder::class,
            '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mentor_study_field');
    }
}
