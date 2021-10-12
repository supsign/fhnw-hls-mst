<?php

namespace Tests\Feature\Services\CourseYear;

use App\Models\Semester;
use App\Services\Course\CourseService;
use App\Services\CourseYear\CourseYearService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseYearServiceTest extends TestCase
{
    use WithFaker;

    private CourseYearService $courseYearService;
    private CourseService $courseService;

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->courseYearService = $this->app->make(CourseYearService::class);
        $this->courseService = $this->app->make(CourseService::class);
    }

    public function testCreateCourseYear()
    {
        $uniqueNumber = $this->faker->unique()->name;
        $name = $this->faker->name;
        $course = $this->courseService->firstOrCreateByNumber($uniqueNumber, 1, 1, $name);
        $semester = Semester::first();
        $courseYear = $this->courseYearService->createCourseYear($course, $semester);
        $this->assertNotNull($courseYear);
        $this->assertEquals($name, $courseYear->name);
    }
}
