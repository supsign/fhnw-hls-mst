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

        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('year');
            $table->boolean('is_has')->default(0);
            $table->timestampsTz();
        });

        Schema::create('course_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('to_semester_id')->constrained('semesters');
            $table->foreignId('from_semester_id')->constrained('semesters');
            $table->boolean('is_acquisition')->default(0);
            $table->timestampsTz();
        });

        Schema::create('study_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Schema::create('study_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_program_id')->constrained();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Schema::create('course_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Schema::create('course_course_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_group_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('start_semester_id')->constrained('semesters');
            $table->timestampsTz();
        });

        Schema::create('specializations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Schema::create('cross_qualifications', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_field_id')->constrained();
            $table->foreignId('specialization_id')->constrained();
            $table->foreignId('cross_qualification_id')->constrained();
            $table->foreignId('start_semester_id')->constrained('semesters');
            $table->timestampsTz();
        });

        Schema::create('course_recommendation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('recommendation_id')->constrained();
            $table->foreignId('semester_id')->constrained();
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
        Schema::dropIfExists('course_recommendation');
        Schema::dropIfExists('recommendations');
        Schema::dropIfExists('cross_qualifications');
        Schema::dropIfExists('specializations');
        Schema::dropIfExists('course_course_group');
        Schema::dropIfExists('course_groups');
        Schema::dropIfExists('study_fields');
        Schema::dropIfExists('study_programs');
        Schema::dropIfExists('course_skill');
        Schema::dropIfExists('semesters');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('taxonomies');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('langauges');
        Schema::dropIfExists('course_types');
    }
}
