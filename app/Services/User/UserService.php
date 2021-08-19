<?php

namespace App\Services\User;

use App\Models\User;
use App\Services\Helpers\hashes;
use App\Services\Mentor\MentorService;
use App\Services\Student\StudentService;

class UserService
{
    use Hashes;

    public function __construct(
        private StudentService $studentService,
        private MentorService $mentorService
    ) {
    }

    public function updateOrCreateUserAsStudent(string $email = null, int $eventoPersonId = null)
    {
        $emailHash = $this->getHash($email);
        $user = $this->updateOrCrateUserOnMailHash($emailHash);

        $student = $this->studentService->getByEventoPersonId($eventoPersonId);

        if (!$student) {
            $user->student_id = null;

            return $user;
        }

        // dissociate existing other user from student
        if ($student->user && $student->user->id != $user->id) {
            $student->user->student()->dissociate()->save();
        }

        $user->student()->associate($student)->save();

        return $user;
    }

    public function udpateOrCreateAsMentor(string $email, int $eventoPersonId, string $firstname = null, string $lastname = null)
    {
        $emailHash = $this->getHash($email);

        $user = $this->updateOrCrateUserOnMailHash($emailHash);

        $mentor = $this->mentorService->createOrUpdateOnEventoPersonId($eventoPersonId, $firstname, $lastname);

        // dissociate existing other user from mentor
        if ($mentor->user && $mentor->user->id != $user->id) {
            $mentor->user->mentor()->dissociate()->save();
        }

        $user->mentor()->associate($mentor)->save();

        return $user;
    }

    private function updateOrCrateUserOnMailHash(string $emailHash)
    {
        return User::updateOrCreate(['email_hash' => $emailHash]);
    }
}
