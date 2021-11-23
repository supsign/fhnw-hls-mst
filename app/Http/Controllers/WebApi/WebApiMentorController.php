<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Services\Mentor\AttachStudentToMentorService;
use App\Services\User\PermissionAndRoleService;
use Auth;

class WebApiMentorController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
    )
    {
    }

    public function attachToStudent(Mentor $mentor, AttachStudentToMentorService $attacheStudentToMentorService): Mentor
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        $user = Auth::user();

        if (!$user->student) {
            abort(409, 'User is not a student.');
        }

        return $attacheStudentToMentorService->attach($mentor, $user->student)->mentor;
    }

    public function detachStudent(Mentor $mentor, AttachStudentToMentorService $attacheStudentToMentorService): void
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        $user = Auth::user();

        if (!$user->student) {
            abort(409, 'User is not a student.');
        }

        $attacheStudentToMentorService->detach($mentor, $user->student);
    }
}
