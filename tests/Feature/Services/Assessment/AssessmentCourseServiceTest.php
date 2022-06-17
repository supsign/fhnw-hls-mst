<?php

namespace Tests\Feature\Services\Assessment;

use App\Models\AssessmentCourse;
use App\Models\Course;
use App\Models\StudyField;
use App\Services\Assessment\AssessmentCourseService;
use App\Services\Assessment\AssessmentService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssessmentCourseServiceTest extends TestCase
{
    use WithFaker;
    private AssessmentService $assessmentService;
    private AssessmentCourseService $assessmentCourseService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->assessmentService = $this->app->make(AssessmentService::class);
        $this->assessmentCourseService = $this->app->make(AssessmentCourseService::class);
    }

    public function testAttache(): void
    {
        $studyField = StudyField::first();
        $assessment = $this->assessmentService->create('blub', $studyField);
        $course = Course::first();

        $this->assessmentCourseService->attach($assessment, $course);
        $this->assertDatabaseHas(AssessmentCourse::class, ['assessment_id' => $assessment->id, 'course_id' => $course->id]);

        $this->assessmentCourseService->attach($assessment, $course);
        $this->assertEquals(1, $assessment->courses->count());
    }
}
