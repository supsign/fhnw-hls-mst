<?php

namespace Tests\Feature\Services\StudyFieldYear;

use App\Models\StudyFieldYear;
use App\Services\Assessment\AssessmentService;
use App\Services\StudyFieldYear\StudyFieldYearService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudyFieldYearServiceTest extends TestCase
{
    use WithFaker;

    protected StudyFieldYearService $studyFieldYearService;
    protected AssessmentService $assessmentService;

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->studyFieldYearService = $this->app->make(StudyFieldYearService::class);
        $this->assessmentService = $this->app->make(AssessmentService::class);
    }

    public function testAttachAssessment(): void
    {
        $studyFieldYear = $this->studyFieldYearService->getByEventoId(9311732);
        $assessment = $this->assessmentService->create('blub', $studyFieldYear->studyField);
        $studyFieldYearAttached = $this->studyFieldYearService->attacheAssessment($studyFieldYear, $assessment);

        $this->assertEquals($studyFieldYear->id, $studyFieldYearAttached->id);

        $studyFieldYearById = StudyFieldYear::find($studyFieldYearAttached->id);
        $this->assertNotNull($studyFieldYearById);
        $this->assertEquals($assessment->id, $studyFieldYearById->assessment_id);
    }
}
