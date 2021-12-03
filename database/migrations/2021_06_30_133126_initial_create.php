<?php

use App\Imports\AssessmentImport;
use App\Imports\CompletionAttemptImport;
use App\Imports\CompletionCreditImport;
use App\Imports\CourseCourseGroupYearImporter;
use App\Imports\CourseCrossQualificationYearImport;
use App\Imports\CourseCsvImport;
use App\Imports\CourseExcelImport;
use App\Imports\CourseGroupImport;
use App\Imports\CourseGroupYearCsvImport;
use App\Imports\CourseSpecializationYearImport;
use App\Imports\CourseYearImport;
use App\Imports\CrossQualificationImport;
use App\Imports\LessonCleanup;
use App\Imports\LessonImport;
use App\Imports\SkillImport;
use App\Imports\SkillPrerequisiteImport;
use App\Imports\SpecializationImport;
use App\Imports\StudentImport;
use App\Imports\StudyFieldImport;
use App\Imports\StudyFieldYearImport;
use App\Services\Semester\SemesterService;
use Carbon\Carbon;
use Database\Seeders\CompletionTypeSeeder;
use Database\Seeders\CourseTypeSeeder;
use Database\Seeders\LanguageSeeder;
use Database\Seeders\StudyFieldSeeder;
use Database\Seeders\StudyProgramSeeder;
use Database\Seeders\TaxonomySeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class InitialCreate extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('amount_to_pass')->nullable();
            $table->timestampsTz();
        });

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
            $table->foreignId('study_program_id')->nullable()->constrained();
            $table->unsignedBigInteger('evento_id')->nullable()->unique();
            $table->string('evento_number')->nullable()->unique();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Artisan::call('db:seed', [
            '--class' => StudyFieldSeeder::class,
            '--force' => true,
        ]);

        $excel = App::make(Excel::class);

        if (App::environment('testing')) {
            if (Storage::exists('Testingdata\Tab1_Studiengang.xlsx')) {
                $excel->import(new StudyFieldImport, 'Testingdata\Tab1_Studiengang.xlsx');
            }
        } else {
            if (Storage::exists('Tab1_Studiengang.xlsx')) {
                $excel->import(new StudyFieldImport, 'Tab1_Studiengang.xlsx');
            }
        }

        Schema::create('specializations', function (Blueprint $table) {
            $table->id();
            $table->integer('janis_id')->nullable()->unique();
            $table->foreignId('study_field_id')->constrained();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Schema::create('cross_qualifications', function (Blueprint $table) {
            $table->id();
            $table->integer('janis_id')->nullable()->unique();
            $table->foreignId('study_field_id')->constrained();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('previous_semester_id')->nullable()->constrained('semesters');
            $table->smallInteger('year');
            $table->boolean('is_hs')->default(1);
            $table->timestampTz('start_date');
            $table->timestampsTz();

            $table->unique(['year', 'is_hs']);
        });

        $semesterService = App::make(SemesterService::class);
        $semesterService->firstOrcreateByYear(Carbon::now()->year + 5);

        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->timestampsTz();
        });

        Schema::create('study_field_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->nullable()->constrained();
            $table->foreignId('begin_semester_id')->constrained('semesters');
            $table->foreignId('origin_study_field_year_id')->nullable()->constrained('study_field_years');
            $table->foreignId('recommendation_id')->nullable()->constrained();
            $table->foreignId('study_field_id')->constrained();
            $table->unsignedBigInteger('evento_id')->nullable()->unique();
            $table->string('evento_number')->nullable()->unique();
            $table->boolean('is_specialization_mandatory')->default(0);
            $table->timestampsTz();
        });

        if (App::environment('testing')) {
            if (Storage::exists('Testingdata\Tab2_Studienjahrgang.xlsx')) {
                $excel->import(new StudyFieldYearImport, 'Testingdata\Tab2_Studienjahrgang.xlsx');
            }
        } else {
            if (Storage::exists('Tab2_Studienjahrgang.xlsx')) {
                $excel->import(new StudyFieldYearImport, 'Tab2_Studienjahrgang.xlsx');
            }
        }

        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_type_id')->constrained();
            $table->foreignId('language_id')->default(1)->constrained();
            $table->foreignId('study_field_id')->nullable()->constrained();
            $table->unsignedBigInteger('evento_id')->nullable()->unique();
            $table->string('number')->unique();
            $table->string('number_unformated')->nullable()->unique();
            $table->string('name')->nullable();
            $table->text('contents')->nullable();
            $table->integer('credits')->default(0);
            $table->boolean('is_fs')->default(1);
            $table->boolean('is_hs')->default(1);
            $table->timestampsTz();
        });

        (new CourseCsvImport)->import();

        Schema::create('specialization_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->nullable()->constrained();
            $table->foreignId('recommendation_id')->nullable()->constrained();
            $table->foreignId('specialization_id')->constrained();
            $table->foreignId('study_field_year_id')->constrained();
            $table->integer('amount_to_pass')->nullable();
            $table->timestampsTz();

            $table->unique(['specialization_id', 'study_field_year_id']);
        });

        Schema::create('course_specialization_year', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('specialization_year_id')->constrained();
            $table->timestampsTz();
        });

        (new SpecializationImport)->import();
        (new CourseSpecializationYearImport)->import();

        Schema::create('cross_qualification_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->nullable()->constrained();
            $table->foreignId('cross_qualification_id')->constrained();
            $table->foreignId('recommendation_id')->nullable()->constrained();
            $table->foreignId('study_field_year_id')->constrained();
            $table->integer('amount_to_pass')->nullable();
            $table->timestampsTz();

            $table->unique(['cross_qualification_id', 'study_field_year_id']);
        });

        Schema::create('course_cross_qualification_year', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('cross_qualification_year_id')->constrained();
            $table->timestampsTz();
        });

        (new CrossQualificationImport)->import();
        (new CourseCrossQualificationYearImport)->import();

        Schema::create('course_groups', function (Blueprint $table) {
            $table->id();
            $table->string('import_id')->nullable()->unique();
            $table->foreignId('study_field_id')->nullable()->constrained();
            $table->string('name');
            $table->timestampsTz();
        });

        (new CourseGroupImport())->import();

        Schema::create('course_group_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_group_id')->constrained();
            $table->foreignId('study_field_year_id')->constrained();
            $table->integer('amount_to_pass')->nullable();
            $table->integer('credits_to_pass')->nullable();
            $table->timestampsTz();
        });

        (new CourseGroupYearCsvImport)->import();

        Schema::create('course_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('skill_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('from_semester_id')->constrained('semesters');
            $table->foreignId('to_semester_id')->nullable()->constrained('semesters');
            $table->integer('goal_number')->nullable();
            $table->boolean('is_acquisition')->default(0);
            $table->timestampsTz();
        });

        (new SkillImport)->import();
        (new SkillPrerequisiteImport)->import();

        Schema::create('course_years', function (Blueprint $table) {
            $table->id();
            $table->foreignId('semester_id')->constrained();
            $table->foreignId('course_id')->constrained();
            $table->unsignedBigInteger('evento_id')->nullable()->unique();
            $table->string('number')->unique();
            $table->string('name')->nullable();
            $table->text('contents')->nullable();
            $table->boolean('is_audit')->default(0);
            $table->timestampsTz();
        });

        Schema::create('course_recommendation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('recommendation_id')->constrained();
            $table->unsignedInteger('planned_semester');
            $table->timestampsTz();
        });

        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_year_id')->constrained();
            $table->timestampTz('start_date');
            $table->timestampTz('end_date');
            $table->timestampsTz();
        });

        Schema::create('assessment_course', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained();
            $table->foreignId('assessment_id')->constrained();
            $table->timestampsTz();
            $table->unique(['course_id', 'assessment_id']);
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
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->timestampsTz();
        });

        Schema::create('completion_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestampsTz();
        });

        Artisan::call('db:seed', [
            '--class' => CompletionTypeSeeder::class,
            '--force' => true,
        ]);

        Schema::create('completions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_year_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->unsignedBigInteger('evento_id')->nullable()->unique();
            $table->integer('credits')->default(0);
            $table->foreignId('completion_type_id')->default(1)->constrained();
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

        (new AssessmentImport)->import();
        (new CourseCourseGroupYearImporter)->import();
        (new CrossQualificationImport)->countAmountToPass();
        (new SpecializationImport)->countAmountToPass();

        if (true || App::environment('testing')) {
            if (Storage::exists('Testingdata\Tab3_Modul.xlsx')) {
                $excel->import(new CourseExcelImport, 'Testingdata\Tab3_Modul.xlsx');
            }

            if (Storage::exists('Testingdata\Tab4_Modulanlass.xlsx')) {
                $excel->import(new CourseYearImport, 'Testingdata\Tab4_Modulanlass.xlsx');
            }
            if (Storage::exists('Testingdata\Tab6_AnmMA.xlsx')) {
                $excel->import(new CompletionAttemptImport, 'Testingdata\Tab6_AnmMA.xlsx');
            }

            if (Storage::exists('Testingdata\Tab7_Anrechnungen.xlsx')) {
                $excel->import(new CompletionCreditImport, 'Testingdata\Tab7_Anrechnungen.xlsx');
            }

            if (Storage::exists('Testingdata\Tab8_Lektionen.xlsx')) {
                $excel->import(new LessonCleanup, 'Testingdata\Tab8_Lektionen.xlsx');
            }

            if (Storage::exists('Testingdata\Tab8_Lektionen.xlsx')) {
                $excel->import(new LessonImport, 'Testingdata\Tab8_Lektionen.xlsx');
            }
        } else {
            if (Storage::exists('Tab3_Modul.xlsx')) {
                $excel->import(new CourseExcelImport, 'Tab3_Modul.xlsx');
            }

            if (Storage::exists('Tab4_Modulanlass.xlsx')) {
                $excel->import(new CourseYearImport, 'Tab4_Modulanlass.xlsx');
            }

            if (Storage::exists('Tab5_AnmStdjg.xlsx')) {
                $excel->import(new StudentImport, 'Tab5_AnmStdjg.xlsx');
            }

            if (Storage::exists('Tab6_AnmMA.xlsx')) {
                $excel->import(new CompletionAttemptImport, 'Tab6_AnmMA.xlsx');
            }

            if (Storage::exists('Tab7_Anrechnungen.xlsx')) {
                $excel->import(new CompletionCreditImport, 'Tab7_Anrechnungen.xlsx');
            }

            if (Storage::exists('Tab8_Lektionen.xlsx')) {
                $excel->import(new LessonCleanup, 'Tab8_Lektionen.xlsx');
            }

            if (Storage::exists('Tab8_Lektionen.xlsx')) {
                $excel->import(new LessonImport, 'Tab8_Lektionen.xlsx');
            }
        }
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
        Schema::dropIfExists('completion_types');
    }
}
