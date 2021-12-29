<?php

namespace Tests\Feature\Services\CrossQualification;

use App\Models\CrossQualification;
use App\Models\StudyFieldYear;
use App\Services\Course\CourseService;
use App\Services\CourseCrossQualificationYear\CourseCrossQualificationYearService;
use App\Services\CrossQualificationYear\CrossQualificationYearService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CourseCrossQualificationYearServiceTest extends TestCase
{
    use WithFaker;

    private CrossQualificationYearService $crossQualificationYearService;
    private CourseService $courseService;
    private CourseCrossQualificationYearService $courseCrossQualificationYearService;

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->crossQualificationYearService = $this->app->make(CrossQualificationYearService::class);
        $this->courseService = $this->app->make(CourseService::class);
        $this->courseCrossQualificationYearService = $this->app->make(CourseCrossQualificationYearService::class);
    }

    public function testAddCourse(): void
    {
        $crossQualification = CrossQualification::where(['janis_id' => 33])->first();
        $studyFieldYear = StudyFieldYear::where(['evento_number' => '2-L-B-LSCH/19.a-SJ'])->first();
        $crossQualificationYear = $this->crossQualificationYearService->findByCrossQualificationAndStudyFieldYear($crossQualification, $studyFieldYear);
        $uniqueNumber = $this->faker->unique()->name;
        $course = $this->courseService->firstOrCreateByNumber($uniqueNumber, 1);
        $courseCrossQualificationYear = $this->courseCrossQualificationYearService->add($crossQualificationYear, $course);
        $this->assertNotNull($courseCrossQualificationYear);
    }

    public function testRemoveCourse(): void
    {
        $crossQualification = CrossQualification::where(['janis_id' => 33])->first();
        $studyFieldYear = StudyFieldYear::where(['evento_number' => '2-L-B-LSCH/19.a-SJ'])->first();
        $crossQualificationYear = $this->crossQualificationYearService->findByCrossQualificationAndStudyFieldYear($crossQualification, $studyFieldYear);
        $uniqueNumber = $this->faker->unique()->name;
        $course = $this->courseService->firstOrCreateByNumber($uniqueNumber, 1);
        $courseCrossQualificationYear = $this->courseCrossQualificationYearService->add($crossQualificationYear, $course);

        $count1 = $crossQualificationYear->courses()->count();
        $this->courseCrossQualificationYearService->remove($courseCrossQualificationYear);
        $count2 = $crossQualificationYear->courses()->count();
        $this->assertEquals($count1 - 1, $count2);
    }
}
