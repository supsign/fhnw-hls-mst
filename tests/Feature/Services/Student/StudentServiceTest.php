<?php

namespace Tests\Feature\Services\Student;

use App\Services\Student\StudentService;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class StudentServiceTest extends TestCase
{
    public function testUpdateOrCreate()
    {
        $studentService = $this->app->make(StudentService::class);
        $mentor = $studentService->createOrUpdateOnEventoPersonId('12347');
        $this->assertTrue((bool)$mentor);
    }

    public function testGetByEventoPersonId()
    {
        $studentService = $this->app->make(StudentService::class);
        $mentor = $studentService->createOrUpdateOnEventoPersonId('12347');
        $this->assertTrue((bool)$mentor);
        $mentor2 = $studentService->getByEventoPersonId('12347');
        $this->assertTrue((bool)$mentor2);
    }
}
