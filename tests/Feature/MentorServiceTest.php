<?php

namespace Tests\Feature;

use App\Services\Mentor\MentorService;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class MentorServiceTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testUpdateOrCreate()
    {
        $mentorService = $this->app->make(MentorService::class);
        $mentor = $mentorService->createOrUpdateOnEventoPersonId('1234', 'Zehnder', 'Beat');
        $this->assertTrue((bool) $mentor);
    }
}
