<?php

namespace Tests\Feature\Services\Planning;

use App\Models\StudyFieldYear;
use App\Services\Planning\LockPlanningService;
use App\Services\Planning\PlanningService;
use App\Services\Student\StudentService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LockPlanningServiceTest extends TestCase
{
    use WithFaker;
    private PlanningService $planningService;
    private StudentService $studentService;
    private LockPlanningService $lockPlanningService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->planningService = $this->app->make(PlanningService::class);
        $this->studentService = $this->app->make(StudentService::class);
        $this->lockPlanningService = $this->app->make(LockPlanningService::class);
    }

    public function testLockPlanning(): void
    {
        $student = $this->studentService->createOrUpdateOnEventoPersonId(1);
        $studyFieldYear = StudyFieldYear::where(['evento_number' => '2-L-B-LSCH/19.a-SJ'])->first();
        $planning = $this->planningService->createEmptyPlanning($student, $studyFieldYear);
        $planning = $this->lockPlanningService->lock($planning);
        $this->assertTrue($planning->is_locked);
    }

    public function testUnLockPlanning(): void
    {
        $student = $this->studentService->createOrUpdateOnEventoPersonId(1);
        $studyFieldYear = StudyFieldYear::where(['evento_number' => '2-L-B-LSCH/19.a-SJ'])->first();
        $planning = $this->planningService->createEmptyPlanning($student, $studyFieldYear);
        $planning = $this->lockPlanningService->lock($planning);
        $planning = $this->lockPlanningService->unLock($planning);
        $this->assertFalse($planning->is_locked);
    }
}
