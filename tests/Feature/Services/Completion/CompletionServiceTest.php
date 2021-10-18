<?php

namespace Tests\Feature\Services\Completion;

use App\Services\Completion\CompletionService;
use App\Services\Course\CourseService;
use App\Services\CourseYear\CourseYearService;
use App\Services\Student\StudentService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompletionServiceTest extends TestCase
{
    use WithFaker;

    private StudentService $studentService;
    private CompletionService $completionService;
    private CourseService $courseService;
    private CourseYearService $courseYearService;

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->studentService = $this->app->make(StudentService::class);
        $this->completionService = $this->app->make(CompletionService::class);
        $this->courseService = $this->app->make(CourseService::class);
        $this->courseYearService = $this->app->make(CourseYearService::class);
    }

    public function testAddCompletionAsCredit()
    {
        $student = $this->studentService->createOrUpdateOnEventoPersonId(5);
        $uniqueNumber = $this->faker->unique()->name;
        $course = $this->courseService->firstOrCreateByNumber($uniqueNumber, 1, 1, 'blub', 3);
        $courseYear = $this->courseYearService->createOrUpdateOnEventoId(
            $this->faker->unique->numberBetween(1, 9999999),
            $course,
            '2-21FS.BlubbBlah.EN/a',
        );
        $completion = $this->completionService->createOrUpdateAsCredited($student, $courseYear->id, $course->credits);
        $this->assertNotNull($completion);
        $this->assertNotNull($completion->id);
        $this->assertEquals(4, $completion->completion_type_id);
    }
}
