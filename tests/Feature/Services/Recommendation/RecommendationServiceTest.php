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

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->recommendationService = $this->app->make(recommendationService::class);
        $this->planningService = $this->app->make(PlanningService::class);
        $this->studentService = $this->app->make(StudentService::class);
    }

    public function testCreateRecommendation()
    {
        $recommendation = $this->recommendationService->create('test');
        $this->assertNotNull($recommendation->id);
        $this->assertDatabaseHas(Recommendation::class, ['id' => $recommendation->id]);
    }

    public function testGetApplicableRecommendation()
    {
        $recommendation = $this->recommendationService->create('test');
        $student = $this->studentService->createOrUpdateOnEventoPersonId('10');
        $studyFieldYear = StudyFieldYear::first();
        $studyFieldYear->recommendation_id = $recommendation->id;
        $studyFieldYear->save();

        $planning = $this->planningService->createEmptyPlanning($student, $studyFieldYear);

        $recommendationFromPlanning = $this->recommendationService->getApplicableRecommendation($planning);

        $this->assertEquals($recommendation->id, $recommendationFromPlanning->id);
    }
}
