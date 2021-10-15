<?php

namespace Tests\Feature\Services\Completion;

use App\Models\CourseYear;
use App\Services\Completion\CompletionService;
use App\Services\Course\CourseService;
use App\Services\Student\StudentService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompletionServiceTest extends TestCase
{
    use WithFaker;

    private StudentService $studentService;
    private CompletionService $completionService;
    private courseService $courseService;

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->studentService = $this->app->make(StudentService::class);
        $this->completionService = $this->app->make(CompletionService::class);
        $this->courseService = $this->app->make(CourseService::class);
    }

    public function testAddCompletionAsCredit()
    {
        $student = $this->studentService->createOrUpdateOnEventoPersonId(5);
        $uniqueNumber = $this->faker->unique()->name;
        $course = $this->courseService->firstOrCreateByNumber($uniqueNumber, 1, 1, 'blub', 3);
        $courseYear = CourseYear::first();
        $completion = $this->completionService->createOrUpdateAsCredited($student, $courseYear->id, $course->credits);
        $this->assertNotNull($completion);
        $this->assertNotNull($completion->id);
        $this->assertEquals(4, $completion->completion_type_id);
    }
}
