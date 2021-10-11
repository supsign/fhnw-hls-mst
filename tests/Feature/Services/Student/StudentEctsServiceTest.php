<?php

namespace Tests\Feature\Services\Student;

use App\Services\Student\StudentEctsService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentEctsServiceTest extends TestCase
{
    use WithFaker;

    private StudentEctsService $studentEctsService;

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->studentEctsService = $this->app->make(StudentEctsService::class);
    }

    public function testCountEctsService()
    {
    }
}
