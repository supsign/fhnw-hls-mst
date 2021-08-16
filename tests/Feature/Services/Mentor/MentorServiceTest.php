<?php

namespace Tests\Feature\Services\Mentor;

use App\Services\Mentor\MentorService;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class MentorServiceTest extends TestCase
{

    public function testUpdateOrCreate()
    {
        $mentorService = $this->app->make(MentorService::class);
        $mentor = $mentorService->createOrUpdateOnEventoPersonId('1234', 'Zehnder', 'Beat');
        $this->assertTrue((bool) $mentor);
    }

    public function testGetByEventoPersonId()
    {
        $mentorService = $this->app->make(MentorService::class);
        $mentor = $mentorService->createOrUpdateOnEventoPersonId('1234', 'Zehnder', 'Beat');
        $this->assertTrue((bool) $mentor);
        $mentor2 = $mentorService->getByEventoPersonId('1234');
        $this->assertTrue((bool) $mentor2);
    }
}
