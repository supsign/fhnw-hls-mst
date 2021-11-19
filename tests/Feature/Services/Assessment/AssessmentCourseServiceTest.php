<?php

namespace Tests\Feature\Services\Assessment;

use App\Models\AssessmentCourse;
use App\Models\Course;
use App\Services\Assessment\AssessmentCourseService;
use App\Services\Assessment\AssessmentService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssessmentCourseServiceTest extends TestCase
{
    use WithFaker;

    private AssessmentService $assessmentService;
    private AssessmentCourseService $assessmentCourseService;


    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->assessmentService = $this->app->make(AssessmentService::class);
        $this->assessmentCourseService = $this->app->make(AssessmentCourseService::class);

    }

    public function testAttache(): void
    {
        $assessemnt = $this->assessmentService->create('blub');
        $course = Course::first();

        $this->assessmentCourseService->attache($assessemnt, $course);
        $this->assertDatabaseHas(AssessmentCourse::class, ['assessment_id' => $assessemnt->id, 'course_id' => $course->id]);

        $this->assessmentCourseService->attache($assessemnt, $course);
        $this->assertEquals(1, $assessemnt->courses->count());

    }


}
