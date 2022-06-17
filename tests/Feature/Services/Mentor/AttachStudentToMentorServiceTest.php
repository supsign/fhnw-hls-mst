<?php

namespace Tests\Feature\Services\Mentor;

use App\Models\MentorStudent;
use App\Services\Mentor\AttachStudentToMentorService;
use App\Services\Mentor\MentorService;
use App\Services\Student\StudentService;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class AttachStudentToMentorServiceTest extends TestCase
{
    use WithFaker;

    private MentorService $mentorService;
    private StudentService $studentService;
    private AttachStudentToMentorService $attacheStudentToMentorService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->mentorService = $this->app->make(MentorService::class);
        $this->studentService = $this->app->make(StudentService::class);
        $this->attacheStudentToMentorService = $this->app->make(AttachStudentToMentorService::class);
    }

    public function testAttachStudentToMentor()
    {
        $mentorEventoId = $this->faker->unique()->numberBetween(1000, 9999);
        $studentEventId = $this->faker->unique()->numberBetween(1000, 9999);
        $student = $this->studentService->createOrUpdateOnEventoPersonId($mentorEventoId);
        $mentor = $this->mentorService->createOrUpdateOnEventoPersonId($studentEventId);

        $this->attacheStudentToMentorService->attach($mentor, $student);

        $this->assertDatabaseHas(MentorStudent::class, ['mentor_id' => $mentor->id, 'student_id' => $student->id]);
    }
}
