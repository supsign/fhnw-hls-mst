<?php

namespace Tests\Feature\Services\Planning;

use App\Models\StudyFieldYear;
use App\Services\Planning\PlanningService;
use App\Services\Student\StudentService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlanningServiceTest extends TestCase
{
    use WithFaker;
    private PlanningService $planningService;
    private StudentService $studentService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->planningService = $this->app->make(PlanningService::class);
        $this->studentService = $this->app->make(StudentService::class);
    }

    public function testCreateEmptyPlanning(): void
    {
        $student = $this->studentService->createOrUpdateOnEventoPersonId(1);
        $studyFieldYear = StudyFieldYear::where(['evento_number' => '2-L-B-LSCH/19.a-SJ'])->first();
        $planning = $this->planningService->createEmptyPlanning($student, $studyFieldYear);
        $this->assertNotNull($planning);
    }
}
