<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Services\Mentor\AttacheStudentToMentorService;
use App\Services\User\PermissionAndRoleService;
use Auth;

class WebApiMentorController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
    ) {
    }

    public function attachToStudent(Mentor $mentor, AttacheStudentToMentorService $attacheStudentToMentorService): Mentor
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        $user = Auth::user();

        if (!$user->student) {
            abort(409, 'User is not a student.');
        }

        return $attacheStudentToMentorService->attache($mentor, $user->student)->mentor;
    }

    public function detachStudent(Mentor $mentor, AttacheStudentToMentorService $attacheStudentToMentorService): void
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        $user = Auth::user();

        if (!$user->student) {
            abort(409, 'User is not a student.');
        }

        $attacheStudentToMentorService->detach($mentor, $user->student);
    }
}
