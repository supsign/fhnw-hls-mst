<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Services\Mentor\AttachStudentToMentorService;
use App\Services\Mentor\MentorService;
use App\Services\User\PermissionAndRoleService;
use Auth;
use Illuminate\Support\Facades\Request;

class WebApiMentorController extends Controller
{
    public function __construct(
        protected MentorService $mentorService,
        protected PermissionAndRoleService $permissionAndRoleService,
    ) {
    }

    public function attachToStudent(Mentor $mentor, AttachStudentToMentorService $attacheStudentToMentorService): Mentor
    {
        $user = Auth::user();
        $this->permissionAndRoleService->canPlanMySchedulesOrAbort($user->student);

        if (!$user->student) {
            abort(409, 'User is not a student.');
        }

        return $attacheStudentToMentorService->attach($mentor, $user->student)->mentor;
    }

    public function detachStudent(Mentor $mentor, AttachStudentToMentorService $attacheStudentToMentorService): void
    {
        $user = Auth::user();
        $this->permissionAndRoleService->canPlanMySchedulesOrAbort($user->student);

        if (!$user->student) {
            abort(409, 'User is not a student.');
        }

        $attacheStudentToMentorService->detach($mentor, $user->student);
    }

    public function getByEventoId(Request $request)
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return $this->mentorService->getByEventoPersonId($request->eventoId);
    }
}
