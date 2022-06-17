<?php

namespace Tests\Feature\Services\Student;

use App\Models\StudyFieldYear;
use App\Services\Completion\CompletionService;
use App\Services\Course\CourseService;
use App\Services\CourseYear\CourseYearService;
use App\Services\Student\StudentCreditService;
use App\Services\Student\StudentService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentCreditServiceTest extends TestCase
{
    use WithFaker;

    private StudentCreditService $studentEctsService;
    private StudentService $studentService;
    private CompletionService $completionService;
    private CourseService $courseService;
    private CourseYearService $courseYearService;

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->studentEctsService = $this->app->make(StudentCreditService::class);
        $this->studentService = $this->app->make(StudentService::class);
        $this->completionService = $this->app->make(CompletionService::class);
        $this->courseService = $this->app->make(CourseService::class);
        $this->courseYearService = $this->app->make(CourseYearService::class);
    }

    public function testCountEctsServiceAsString()
    {
        $studentEventoId = $this->faker->unique()->numberBetween(1, 9999999);
        $student = $this->studentService->createOrUpdateOnEventoPersonId($studentEventoId);
        $credits = $this->studentEctsService->getCreditsAsString($student);
        $this->assertEquals('-', $credits);

        $studyFieldYear = StudyFieldYear::inRandomOrder()->first();
        $student->update(['study_field_year_id' => $studyFieldYear->id]);
        $course = $studyFieldYear->courses->first();
        $this->courseYearService->createOrUpdateOnEventoId(
            $this->faker->unique()->numberBetween(1, 9999999),
            $course,
            '2-21FS.somestupiduniquestring.EN/a',
            'test'
        );
        $this->completionService->createOrUpdateOnEventoIdAsCredit(
            $this->faker->unique()->numberBetween(1, 9999999),
            $student,
            $course,
            $course->credits,
        );
        $credits = $this->studentEctsService->getCreditsAsString($student);
        $this->assertEquals($course->credits, $credits);
    }
}
