<?php

namespace Tests\Feature\Services\Course;

use App\Services\Course\CourseService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseServiceTest extends TestCase
{
    use WithFaker;
    private CourseService $courseService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->courseService = $this->app->make(CourseService::class);
    }

    public function testCreatCourseByNumber()
    {
        $uniqueNumber = $this->faker->unique()->name();
        $course1 = $this->courseService->firstOrCreateByNumber($uniqueNumber, 1);
        $this->assertNotNull($course1);
        $course2 = $this->courseService->firstOrCreateByNumber($uniqueNumber, 1);
        $this->assertEquals($course1->id, $course2->id);
    }
}
