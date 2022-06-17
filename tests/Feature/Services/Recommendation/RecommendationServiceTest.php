<?php

namespace Tests\Feature\Services\Recommendation;

use App\Models\Recommendation;
use App\Models\StudyFieldYear;
use App\Services\Planning\PlanningService;
use App\Services\Recommendation\RecommendationService;
use App\Services\Student\StudentService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecommendationServiceTest extends TestCase
{
    use WithFaker;

    private RecommendationService $recommendationService;
    private PlanningService $planningService;
    private StudentService $studentService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->recommendationService = $this->app->make(recommendationService::class);
        $this->planningService = $this->app->make(PlanningService::class);
        $this->studentService = $this->app->make(StudentService::class);
    }

    public function testCreateRecommendation()
    {
        $studyFieldYear = StudyFieldYear::first();
        $recommendation = $this->recommendationService->create('test', $studyFieldYear->studyField);
        $this->assertNotNull($recommendation->id);
        $this->assertDatabaseHas(Recommendation::class, ['id' => $recommendation->id]);
    }

    public function testGetApplicableRecommendation()
    {
        $studyFieldYear = StudyFieldYear::first();
        $recommendation = $this->recommendationService->create('test', $studyFieldYear->studyField);
        $student = $this->studentService->createOrUpdateOnEventoPersonId('10');
        $studyFieldYear->recommendation_id = $recommendation->id;
        $studyFieldYear->save();

        $planning = $this->planningService->createEmptyPlanning($student, $studyFieldYear);

        $recommendationFromPlanning = $this->recommendationService->getApplicableRecommendation($planning);

        $this->assertEquals($recommendation->id, $recommendationFromPlanning->id);
    }
}
