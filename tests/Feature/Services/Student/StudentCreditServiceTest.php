<?php

namespace Tests\Feature\Services\Student;

use App\Models\CourseYear;
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
    private courseService $courseService;

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->studentEctsService = $this->app->make(StudentCreditService::class);
        $this->studentService = $this->app->make(StudentService::class);
        $this->completionService = $this->app->make(CompletionService::class);
        $this->courseService = $this->app->make(CourseService::class);
    }

    public function testCountEctsService()
    {
        $studentEventoId = $this->faker->unique->numberBetween(1, 9999999);
        $student = $this->studentService->createOrUpdateOnEventoPersonId($studentEventoId);

        $uniqueNumber = $this->faker->unique()->name;
        $course = $this->courseService->firstOrCreateByNumber($uniqueNumber, 1, 1, 'blub', 3);
        $courseYear = CourseYear::first();
        $this->completionService->createOrUpdateAsCredited($student, $courseYear->id, $course->credits);
        $credits = $this->studentEctsService->getCredits($student->completions()->get());
        $this->assertEquals($course->credits, $credits);
    }

    public function testCountEctsServiceAsString()
    {
        $studentEventoId = $this->faker->unique->numberBetween(1, 9999999);
        $student = $this->studentService->createOrUpdateOnEventoPersonId($studentEventoId);

        $uniqueNumber = $this->faker->unique()->name;
        $course = $this->courseService->firstOrCreateByNumber($uniqueNumber, 1, 1, 'blub', 3);
        $courseYear = CourseYear::first();

        $credits = $this->studentEctsService->getCreditsAsString($student);
        $this->assertEquals('-', $credits);

        $this->completionService->createOrUpdateAsCredited($student, $courseYear->id, $course->credits);
        $credits = $this->studentEctsService->getCreditsAsString($student);
        $this->assertEquals((string)$course->credits, $credits);
    }
}
