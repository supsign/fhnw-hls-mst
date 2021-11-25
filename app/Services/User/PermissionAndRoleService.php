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
        if (!Auth::user()->hasPermissionTo('show app')) {
            abort(403, __('l.noAccess'));
        }

        return $this;
    }

    public function canManageBackendOrAbort(): self
    {
        if (!Auth::user()->hasPermissionTo('manage backend')) {
            abort(403, __('l.noAccess'));
        }

        return $this;
    }

    public function canPlanScheduleOrAbort(): self
    {
        if (!Auth::user()->hasPermissionTo('plan schedule')) {
            abort(403, __('l.noAccess'));
        }

        return $this;
    }

    public function canPlanMySchedulesOrAbort(Planning $planning): self
    {
        $user = Auth::user();

        if (!$user->hasPermissionTo('plan my schedules')) {
            abort(403, __('l.noAccess'));
        }

        if ($planning->student_id !== $user->student_id) {
            abort(403, __('l.noAccess'));
        }

        return $this;
    }

    public function canPlanStudentSchedulesOrAbort(Student $student, Planning $planning = null): self
    {
        $user = Auth::user();

        $hasPermisson = $user->hasPermissionTo('plan students schedules');

        $mentor = $user->mentor;

        $stuentsOfMentor = $mentor?->students ?? collect();

        $isMentorOfStudent = $stuentsOfMentor->contains($student);

        if (!$hasPermisson || !$mentor || !$isMentorOfStudent) {
            abort(403, __('l.noAccess'));
        }

        if ($planning && $planning->student_id !== $student->id) {
            abort(403, __('l.noAccess'));
        }

        return $this;
    }
}
