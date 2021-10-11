<?php

namespace Tests\Feature\Services\Planning;

use App\Models\CoursePlanning;
use App\Models\Semester;
use App\Services\Planning\CoursePlanningService;
use App\Services\Planning\PlanningService;
use App\Services\Student\StudentService;
use App\Services\StudyFieldYear\StudyFieldYearService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class CoursePlanningServiceTest extends TestCase
{
    use WithFaker;

    public CoursePlanningService $coursePlanningService;
    public StudentService $studentService;
    public StudyFieldYearService $studyFieldYearService;
    public PlanningService $planningService;

    public function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->coursePlanningService = $this->app->make(CoursePlanningService::class);
        $this->studentService = $this->app->make(StudentService::class);
        $this->studyFieldYearService = $this->app->make(StudyFieldYearService::class);
        $this->planningService = $this->app->make(PlanningService::class);
    }

    public function testPlanCourse()
    {
        $student = $this->studentService->createOrUpdateOnEventoPersonId(5);
        $studyFieldYear = $this->studyFieldYearService->getByEventoId('1252215');
        $planning = $this->planningService->createEmptyPlanning($student->id, $studyFieldYear->id);
        $course = $studyFieldYear->courseGroupYears[0]->courses[0];
        $semester = Semester::first();
        $this->coursePlanningService->planCourse($planning, $course, $semester);
        $this->assertDatabaseHas(CoursePlanning::class, ['planning_id' => $planning->id, 'course_id' => $course->id, 'semester_id' => $semester->id]);
    }
}
