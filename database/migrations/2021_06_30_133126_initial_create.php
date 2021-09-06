<?php

use App\Importers\CourseGroupImporter;
use App\Importers\CourseImporter;
use App\Importers\CrossQualificationImporter;
use App\Importers\SkillImporter;
use App\Importers\SkillPrerequisiteImporter;
use App\Importers\SpecializationImporter;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\SemesterSeeder;
use Database\Seeders\StudyFieldSeeder;
use Database\Seeders\StudyProgramSeeder;
use Database\Seeders\TaxonomySeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitialCreate extends Migration
{
    /**
     * Run the migrations.
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
            '--force' => true,
        ]);

        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Artisan::call('db:seed', [
            '--class' => LanguageSeeder::class,
            '--force' => true,
        ]);

        Schema::create('taxonomies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Artisan::call('db:seed', [
            '--class' => TaxonomySeeder::class,
            '--force' => true,
        ]);

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('taxonomy_id')->constrained();
            $table->text('definition');
            $table->timestampsTz();
        });

        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->string('evento_person_id_hash')->unique();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->timestampsTz();
        });

        Schema::create('study_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Artisan::call('db:seed', [
            '--class' => StudyProgramSeeder::class,
            '--force' => true,
        ]);

        Schema::create('study_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_program_id')->constrained();
            $table->unsignedBigInteger('evento_id')->nullable()->unique();
            $table->string('evento_number')->nullable()->unique();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Artisan::call('db:seed', [
            '--class' => StudyFieldSeeder::class,
            '--force' => true,
        ]);

        Schema::create('specializations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_field_id')->constrained();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        (new SpecializationImporter())->import();

        Schema::create('cross_qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_field_id')->constrained();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        (new CrossQualificationImporter())->import();

        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('previous_semester_id')->nullable()->constrained('semesters');
            $table->smallInteger('year');
            $table->boolean('is_hs')->default(0);
            $table->timestampTz('start_date');
            $table->timestampsTz();

            $table->unique(['year', 'is_hs']);
        });

        Artisan::call('db:seed', [
            '--class' => SemesterSeeder::class,
            '--force' => true,
        ]);

        Schema::create('study_field_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('begin_semseter_id')->constrained('semesters');
            $table->foreignId('origin_study_field_year_id')->nullable()->constrained('study_field_years');
            $table->foreignId('study_field_id')->constrained();
            $table->boolean('is_specialization_mandatory')->default(0);
            $table->timestampsTz();
        });

        Schema::create('specialization_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cross_qualification_id')->constrained();
            $table->foreignId('study_field_year_id')->constrained();
            $table->integer('amount_to_pass')->nullable();
            $table->integer('credits_to_pass')->nullable();
            $table->timestampsTz();
        });

        Schema::create('cross_qualification_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cross_qualification_id')->constrained();
            $table->foreignId('study_field_id')->constrained();
            $table->integer('amount_to_pass')->nullable();
            $table->integer('credits_to_pass')->nullable();
            $table->timestampsTz();
        });

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_type_id')->constrained();
            $table->foreignId('language_id')->default(1)->constrained();
            $table->foreignId('study_field_id')->nullable()->constrained();
            $table->string('number')->unique();
            $table->integer('credits')->default(0);
            $table->timestampsTz();
        });

        (new CourseImporter())->import();

        Schema::create('course_groups', function (Blueprint $table) {
            $table->id();
            $table->string('import_id')->nullable()->unique();
            $table->foreignId('study_field_id')->nullable()->constrained();
            $table->string('name');
            $table->timestampsTz();
        });

        (new CourseGroupImporter())->import();

        Schema::create('course_group_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_group_id')->constrained();
            $table->foreignId('study_field_year_id')->constrained();
            $table->integer('amount_to_pass')->nullable();
            $table->integer('credits_to_pass')->nullable();
            $table->timestampsTz();
        });

        Schema::create('course_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('semester_id')->constrained();
            $table->integer('goal_number')->nullable();
            $table->boolean('is_acquisition')->default(0);
            $table->timestampsTz();
        });

        (new SkillImporter())->import();
        (new SkillPrerequisiteImporter())->import();

        Schema::create('course_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->constrained();
            $table->foreignId('study_field_year_id')->constrained();
            $table->unsignedBigInteger('evento_anlass_id')->nullable();
            $table->timestampsTz();
        });

        Schema::create('course_specialization_year', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('specialization_year_id')->constrained();
            $table->timestampsTz();
        });

        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cross_qualification_year_id')->constrained();
            $table->foreignId('specialization_year_id')->constrained();
            $table->foreignId('study_field_year_id')->constrained();
            $table->foreignId('origin_recommendation_id')->nullable()->constrained('recommendations');
            $table->timestampsTz();
        });

        Schema::create('course_recommendation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('recommendation_id')->constrained();
            $table->timestampsTz();
        });

        Schema::create('course_cross_qualification_year', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('cross_qualification_year_id')->constrained();
            $table->timestampsTz();
        });

        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_year_id')->constrained();
            $table->timestampTz('start_date');
            $table->timestampTz('end_date');
            $table->timestampsTz();
        });

        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cross_qualification_year_id')->constrained();
            $table->foreignId('specialization_year_id')->constrained();
            $table->foreignId('study_field_year_id')->constrained();
            $table->integer('amount_to_pass')->nullable();
            $table->integer('credits_to_pass')->nullable();
            $table->timestampsTz();
        });

        Schema::create('assessment_course', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('assessment_id')->constrained();
            $table->timestampsTz();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('study_field_year_id')->nullable()->constrained();
            $table->string('evento_person_id_hash')->unique();
            $table->timestampsTz();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email_hash')->unique();
            $table->foreignId('mentor_id')->nullable()->constrained();
            $table->foreignId('student_id')->nullable()->constrained();
            $table->timestampsTz();
        });

        Schema::create('mentor_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->timestampsTz();
        });

        Schema::create('completions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_year_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->integer('credits')->default(0);
            $table->boolean('is_fulfilled')->default(false);
            $table->timestampsTz();
        });

        Schema::create('plannings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cross_qualification_year_id')->nullable()->constrained();
            $table->foreignId('mentor_id')->nullable()->constrained();
            $table->foreignId('specialization_year_id')->nullable()->constrained();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('study_field_year_id')->constrained();
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

        Schema::create('skill_student', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('course_year_id')->constrained();
            $table->timestampsTz();
        });

        Schema::create('course_course_group_year', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_group_year_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('skill_student');
        Schema::dropIfExists('course_planning');
        Schema::dropIfExists('plannings');
        Schema::dropIfExists('completions');
        Schema::dropIfExists('mentor_student');
        Schema::dropIfExists('users');
        Schema::dropIfExists('students');
        Schema::dropIfExists('assessment_course');
        Schema::dropIfExists('assessments');
        Schema::dropIfExists('lessons');
        Schema::dropIfExists('course_cross_qualification_year');
        Schema::dropIfExists('course_recommendation');
        Schema::dropIfExists('recommendations');
        Schema::dropIfExists('course_specialization_year');
        Schema::dropIfExists('course_years');
        Schema::dropIfExists('course_skill');
        Schema::dropIfExists('course_course_group_year');
        Schema::dropIfExists('course_group_years');
        Schema::dropIfExists('course_groups');
        Schema::dropIfExists('courses');
        Schema::dropIfExists('cross_qualification_years');
        Schema::dropIfExists('specialization_years');
        Schema::dropIfExists('study_field_years');
        Schema::dropIfExists('semesters');
        Schema::dropIfExists('cross_qualifications');
        Schema::dropIfExists('specializations');
        Schema::dropIfExists('study_fields');
        Schema::dropIfExists('study_programs');
        Schema::dropIfExists('mentors');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('taxonomies');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('course_types');
    }
}
