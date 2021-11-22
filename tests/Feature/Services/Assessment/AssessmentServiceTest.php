<?php

namespace Tests\Feature\Services\Assessment;

use App\Models\Assessment;
use App\Models\StudyFieldYear;
use App\Services\Assessment\AssessmentService;
use App\Services\Planning\PlanningService;
use App\Services\Student\StudentService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AssessmentServiceTest extends TestCase
{
    use WithFaker;

    private AssessmentService $assessmentService;
    private PlanningService $planningService;
    private StudentService $studentService;

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->assessmentService = $this->app->make(AssessmentService::class);
        $this->planningService = $this->app->make(PlanningService::class);
        $this->studentService = $this->app->make(StudentService::class);
    }

    public function testCreateAssessment()
    {
        $assessment = $this->assessmentService->create('test');
        $this->assertEquals(10, $assessment->amount_to_pass);
        $this->assertNotNull($assessment->id);
        $this->assertDatabaseHas(Assessment::class, ['id' => $assessment->id]);
    }

    public function testGetApplicableAssessment()
    {
        $assessment = $this->assessmentService->create('test');
        $student = $this->studentService->createOrUpdateOnEventoPersonId('10');
        $studyFieldYear = StudyFieldYear::first();
        $studyFieldYear->assessment_id = $assessment->id;
        $studyFieldYear->save();

        $planning = $this->planningService->createEmptyPlanning($student->id, $studyFieldYear->id);

        $assessmentFromPlanning = $this->assessmentService->getApplicableAssessment($planning);

        $this->assertEquals($assessment->id, $assessmentFromPlanning->id);
    }
}
