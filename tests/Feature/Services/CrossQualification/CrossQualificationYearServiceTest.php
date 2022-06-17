<?php

namespace Tests\Feature\Services\CrossQualification;

use App\Models\CrossQualification;
use App\Models\StudyFieldYear;
use App\Services\CrossQualificationYear\CrossQualificationYearService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrossQualificationYearServiceTest extends TestCase
{
    use WithFaker;

    private CrossQualificationYearService $crossQualificationYearService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->crossQualificationYearService = $this->app->make(CrossQualificationYearService::class);
    }

    public function testFindCrossQualificationYear(): void
    {
        $crossQualification = CrossQualification::where(['janis_id' => 33])->first();
        $studyFieldYear = StudyFieldYear::where(['evento_number' => '2-L-B-LSCH/19.a-SJ'])->first();
        $crossQualificationYear = $this->crossQualificationYearService->findByCrossQualificationAndStudyFieldYear($crossQualification, $studyFieldYear);
        $this->assertNotNull($crossQualificationYear);
    }
}
