<?php

use App\Importers\CourseImporter;
use App\Importers\CourseGroupImporter;
use App\Importers\CourseCourseGroupImporter;
use App\Importers\SkillImporter;
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
            $table->foreignId('langauge_id')->default(1)->constrained();
            $table->string('number')->unique();
            $table->string('name')->nullable();
            $table->integer('credits')->default(0);
            $table->timestampsTz();
        });

        (new CourseImporter)->import();

        Schema::create('taxonomies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Artisan::call('db:seed', [
            '--class' => TaxonomySeeder::class,
            '--force' => true
        ]);

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('taxonomy_id')->constrained();
            $table->text('definition');
            $table->timestampsTz();
        });

        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('year');
            $table->boolean('is_hs')->default(0);
            $table->timestampsTz();
        });

        Artisan::call('db:seed', [
            '--class' => SemesterSeeder::class,
            '--force' => true
        ]);

        Schema::create('course_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('to_semester_id')->constrained('semesters');
            $table->foreignId('from_semester_id')->constrained('semesters');
            $table->boolean('is_acquisition')->default(0);
            $table->timestampsTz();
        });

        (new SkillImporter)->import();

        Schema::create('study_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Artisan::call('db:seed', [
            '--class' => StudyProgramSeeder::class,
            '--force' => true
        ]);

        Schema::create('study_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_program_id')->constrained();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Artisan::call('db:seed', [
            '--class' => StudyFieldSeeder::class,
            '--force' => true
        ]);

        Schema::create('course_groups', function (Blueprint $table) {
            $table->id();
            $table->string('import_id')->nullable()->unique();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        (new CourseGroupImporter)->import();

        Schema::create('course_course_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_group_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('start_semester_id')->constrained('semesters');
            $table->timestampsTz();
        });

        (new CourseCourseGroupImporter)->import();

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
            $table->foreignId('cross_qualification_id')->constrained();
            $table->foreignId('specialization_id')->constrained();
            $table->foreignId('start_semester_id')->constrained('semesters');
            $table->foreignId('study_field_id')->constrained();
            $table->timestampsTz();
        });

        Schema::create('course_recommendation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('recommendation_id')->constrained();
            $table->foreignId('semester_id')->constrained();
            $table->timestampsTz();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('semester_id')->constrained();
            $table->unsignedBigInteger('evento_anlass_id');
            $table->timestampsTz();
        });

        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained();
            $table->timestampTz('start_date');
            $table->timestampTz('end_date');
            $table->timestampsTz();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('start_semester_id')->constrained('semesters');
            $table->foreignId('study_field_id')->constrained();
            $table->unsignedBigInteger('evento_person_id');
            $table->timestampsTz();
        });

        Schema::create('completions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->integer('credits')->default(0);
            $table->boolean('is_fulfilled')->default(false);
            $table->timestampsTz();
        });

        Schema::create('course_specialization', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('start_semester_id')->constrained('semesters');
            $table->foreignId('specialization_id')->constrained();
            $table->timestampsTz();
        });

        Schema::create('course_cross_qualification', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('cross_qualification_id')->constrained();
            $table->foreignId('start_semester_id')->constrained('semesters');
            $table->timestampsTz();
        });

        Schema::create('skill_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained();
            $table->foreignId('skill_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->timestampsTz();
        });

        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evento_person_id');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->timestampsTz();
        });

        Schema::create('mentor_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->timestampsTz();
        });

        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('start_semester_id')->constrained('semesters');
            $table->foreignId('study_field_id')->constrained();
            $table->timestampsTz();
        });

        Schema::create('plannings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cross_qualification_id')->constrained();
            $table->foreignId('mentor_id')->constrained();
            $table->foreignId('specialization_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Schema::create('course_planning', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('planning_id')->constrained();
            $table->foreignId('semester_id')->constrained();
            $table->timestampsTz();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained();
            $table->foreignId('student_id')->constrained();
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('course_plannings');
        Schema::dropIfExists('plannings');
        Schema::dropIfExists('assessments');
        Schema::dropIfExists('mentor_student');
        Schema::dropIfExists('mentors');
        Schema::dropIfExists('skill_stundent');
        Schema::dropIfExists('course_cross_qualification');
        Schema::dropIfExists('course_specialization');
        Schema::dropIfExists('completions');
        Schema::dropIfExists('students');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('events');
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
