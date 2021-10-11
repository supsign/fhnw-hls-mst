<?php

namespace Tests\Feature\Services\Student;

use App\Services\Student\StudentEctsService;
use App\Services\Student\StudentService;
use App\Services\StudyFieldYear\StudyFieldYearService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentEctsServiceTest extends TestCase
{
    use WithFaker;

    private StudentEctsService $studentEctsService;
    private StudentService $studentService;
    private StudyFieldYearService $studyFieldYearService;

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->studentEctsService = $this->app->make(StudentEctsService::class);
        $this->studentService = $this->app->make(StudentService::class);
        $this->studyFieldYearService = $this->app->make(StudyFieldYearService::class);
    }

    public function testCountEctsService()
    {
        $student = $this->studentService->createOrUpdateOnEventoPersonId(5);
        $studyFieldYear = $this->studyFieldYearService->getByEventoId('1252215');
    }
}
