<?php

namespace Tests\Feature\Services\Completion;

use App\Services\Completion\CompletionService;
use App\Services\Student\StudentService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompletionServiceTest extends TestCase
{
    use WithFaker;

    private StudentService $studentService;
    private CompletionService $completionService;

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->studentService = $this->app->make(StudentService::class);
        $this->completionService = $this->app->make(CompletionService::class);
    }

    public function testCountEctsService()
    {
        $student = $this->studentService->createOrUpdateOnEventoPersonId(5);

    }
}
