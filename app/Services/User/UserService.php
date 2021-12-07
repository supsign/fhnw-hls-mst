<?php

namespace App\Services\User;

use App;
use App\Models\Mentor;
use App\Models\Student;
use App\Models\User;
use App\Services\Helpers\Hashes;
use App\Services\Mentor\MentorService;
use App\Services\Student\StudentService;

class UserService
{
    use Hashes;

    public function __construct(
        protected StudentService $studentService,
        protected MentorService $mentorService,
        protected PermissionAndRoleService $permissionAndRoleService,
    ) {
    }

    // note the correct spelling of "attach"
    protected function attachMentor(User $user, int $eventoPersonId, string $firstname = null, string $lastname = null): self
    {
        $mentor = $this->mentorService->createOrUpdateOnEventoPersonId($eventoPersonId, $firstname, $lastname);

        if (!$mentor) {
            return $this;
        }

        // dissociate existing other user from mentor
        if ($mentor->user && $mentor->user->id != $user->id) {
            $mentor->user->mentor()->dissociate()->save();
        }

        $user->mentor()->associate($mentor)->save();

        return $this;
    }

    protected function attachStudent(User $user, int $eventoPersonId): self
    {
        $student = App::environment() === 'local'
            ? $student = $this->studentService->createOrUpdateOnEventoPersonId($eventoPersonId)
            : $student = $this->studentService->getByEventoPersonId($eventoPersonId);

        if (!$student) {
            return $this;
        }

        // dissociate existing other user from student
        if ($student->user && $student->user->id != $user->id) {
            $student->user->student()->dissociate()->save();
        }

        $user->student()->associate($student)->save();

        return $this;
    }

    public function getByEmail(string $email): ?User
    {
        return User::where('email_hash', $this->getHash($email))->first();
    }

    public function getById(int $id): ?User
    {
        return User::find($id);
    }

    public function updateOrCreateAsAppAdmin(string $email, int $eventoPersonId, string $firstname = null, string $lastname = null): User
    {
        $user = $this->updateOrCrateUserOnMail($email);

        $this->attachStudent($user, $eventoPersonId);
        $this->attachMentor($user, $eventoPersonId, $firstname, $lastname);
        $this->permissionAndRoleService->assignMentor($user);
        $this->permissionAndRoleService->assignAppAdmin($user);

        return $user;
    }

    public function udpateOrCreateAsMentor(string $email, int $eventoPersonId, string $firstname = null, string $lastname = null): User
    {
        $user = $this->updateOrCrateUserOnMail($email);
        $this->attachMentor($user, $eventoPersonId, $firstname, $lastname);
        $this->permissionAndRoleService->assignMentor($user);

        return $user;
    }

    public function updateOrCreateUserAsStudent(string $email, int $eventoPersonId): User
    {
        $user = $this->updateOrCrateUserOnMail($email);
        $this->attachStudent($user, $eventoPersonId);
        $this->permissionAndRoleService->assignStudent($user);

        return $user;
    }

    protected function updateOrCrateUserOnMail(string $email)
    {
        return User::updateOrCreate(['email_hash' => $this->getHash($email)]);
    }
}
