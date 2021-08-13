<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\Helpers\hashes;
use App\Services\Mentor\MentorService;
use App\Services\Student\StudentService;

class UserService
{
    use hashes;

    public function __construct(
        private StudentService $studentService,
        private MentorService $mentorService
    ) {
    }

    public function updateOrCreateUserAsStudent(string $email, int $eventoPersonId)
    {
        $emailHash = $this->getHash($email);
        $user = $this->updateOrCrateUserOnMailHash($emailHash);

        $student = $this->studentService->getByEventoPersonId($eventoPersonId);

        if (!$student) {
            return $user;
        }

        $user->student()->associate($student);

        return $user;
    }

    public function udpateOrCreateAsMentor(string $email, int $eventoPersonId, string $firstname = null, string $lastname = null)
    {
        $emailHash = $this->getHash($email);

        $user = $this->updateOrCrateUserOnMailHash($emailHash);

        $mentor = $this->mentorService->createOrUpdateOnEventoPersonId($eventoPersonId, $firstname, $lastname);

        $user->mentor()->associate($mentor);

        return $user;
    }

    private function updateOrCrateUserOnMailHash(string $emailHash)
    {
        return User::updateOrCreate(['email_hash' => $emailHash]);
    }
}
