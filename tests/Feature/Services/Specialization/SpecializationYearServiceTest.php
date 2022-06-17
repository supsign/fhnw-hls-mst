<?php

namespace Tests\Feature\Services\Specialization;

use App\Models\Specialization;
use App\Models\StudyFieldYear;
use App\Services\SpecializationYear\SpecializationYearService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpecializationYearServiceTest extends TestCase
{
    use WithFaker;

    private SpecializationYearService $specializationYearService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->specializationYearService = $this->app->make(SpecializationYearService::class);
    }

    public function testFindSpecializationYear(): void
    {
        $specialization = Specialization::where(['janis_id' => 2])->first();
        $studyFieldYear = StudyFieldYear::where(['evento_number' => '2-L-B-LSCH/19.a-SJ'])->first();
        $specializationYear = $this->specializationYearService->findBySpecializationAndStudyFieldYear($specialization, $studyFieldYear);
        $this->assertNotNull($specializationYear);
    }
}
