<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitialCreate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Artisan::call('db:seed', [
            '--class' => CourseTypeSeeder::class,
            '--force' => true
        ]);

        Schema::create('langauges', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Artisan::call('db:seed', [
            '--class' => LangaugeSeeder::class,
            '--force' => true
        ]);

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_type_id')->constrained();
            $table->foreignId('langauge_id')->constrained();
            $table->string('number');
            $table->integer('credits')->default(0);
            $table->timestampsTz();
        });

        Schema::create('taxonomies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('taxonomy_id')->constrained();
            $table->string('definition');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skills');
        Schema::dropIfExists('taxonomies');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('langauges');
        Schema::dropIfExists('course_types');
    }
}
