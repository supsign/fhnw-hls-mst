<?php

namespace App\Services\User;

use App\Models\Planning;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class PermissionAndRoleService
{
    public function getRoleById(int $id): ?Role
    {
        return Role::find($id);
    }

    public function assignStudent(User $user): User
    {
        $user->assignRole('student');

        return $user;
    }

    public function removeStudent(User $user): User
    {
        $user->removeRole('student');

        return $user;
    }

    public function assignMentor(User $user): User
    {
        $user->assignRole('mentor');

        return $user;
    }

    public function removeMentor(User $user): User
    {
        $user->removeRole('mentor');

        return $user;
    }

    public function assignAppAdmin(User $user): User
    {
        $user->assignRole('app-admin');

        return $user;
    }

    public function removeAppAdmin(User $user): User
    {
        $user->removeRole('app-admin');

        return $user;
    }

    public function canShowAppOrAbort(): self
    {
        if (!Auth::user()->can('show app')) {
            abort(403, __('l.noAccess'));
        }

        return $this;
    }

    public function canManageBackendOrAbort(): self
    {
        if (!Auth::user()->can('manage backend')) {
            abort(403, __('l.noAccess'));
        }

        return $this;
    }

    public function canPlanMySchedulesOrAbort(Student $student = null, Planning $planning = null): self
    {
        if (!$this->canPlanMySchedules($student, $planning)) {
            abort(403, __('l.noAccess'));
        }

        return $this;
    }

    protected function canPlanMySchedules(Student $student = null, Planning $planning = null): bool
    {
        if (!$student) {
            return false;
        }

        $user = Auth::user();

        if (!$user->can('plan my schedules')) {
            return false;
        }

        if ($planning && $planning->student_id !== $user->student_id) {
            return false;
        }

        if ($student->id !== $user->student_id) {
            return false;
        }

        return true;
    }

    public function canPlanStudentSchedulesOrAbort(Student $student, Planning $planning = null): self
    {
        if (!$this->canPlanStudentSchedules($student, $planning)) {
            abort(403, __('l.noAccess'));
        }

        return $this;
    }

    protected function canPlanStudentSchedules(Student $student = null, Planning $planning = null): bool
    {
        if (!$student) {
            return false;
        }
        
        $user = Auth::user();
        $hasPermisson = $user->can('plan students schedules');
        $mentor = $user->mentor;
        $stuentsOfMentor = $mentor?->students ?? collect();
        $isMentorOfStudent = $stuentsOfMentor->contains($student);

        if (!$hasPermisson || !$mentor || !$isMentorOfStudent) {
            return false;
        }

        if ($planning && $planning->student_id !== $student->id) {
            return false;
        }

        return true;
    }

    public function canPlanScheduleOrAbort(Student $student, Planning $planning = null): self
    {
        if (
            !$this->canPlanMySchedules($student, $planning) &&
            !$this->canPlanStudentSchedules($student, $planning)
        ) {
            abort(403, __('l.noAccess'));
        }

        return $this;
    }
}
