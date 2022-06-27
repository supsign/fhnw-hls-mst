<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FindAttachMentorStudentRequest;
use App\Models\Mentor;
use App\Models\MentorStudent;
use App\Models\Student;
use App\Services\Mentor\AttachStudentToMentorService;
use App\Services\Mentor\MentorService;
use App\Services\Student\StudentService;
use App\Services\User\PermissionAndRoleService;
use Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;

class WebApiMentorController extends Controller
{
    public function __construct(
        protected MentorService $mentorService,
        protected PermissionAndRoleService $permissionAndRoleService,
    ) {
    }

    public function attachToStudent(Mentor $mentor, Student $student, AttachStudentToMentorService $attacheStudentToMentorService): MentorStudent
    {
        $user = Auth::user();
        $this->permissionAndRoleService->canPlanMySchedulesOrAbort($student);

        if (!$user->student) {
            abort(409, 'User is not a student.');
        }

        return $attacheStudentToMentorService->attach($mentor, $user->student);
    }

    public function findAndAttach(Mentor $mentor, FindAttachMentorStudentRequest $findAttachMentorStudentRequest, AttachStudentToMentorService $attacheStudentToMentorService, StudentService $studentService): MentorStudent
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        /* @var $student Student */
        $student = $studentService->getByEventoPersonId($findAttachMentorStudentRequest->evento_id);

        if (!$student) {
            abort(404, 'student not found');
        }

        return $attacheStudentToMentorService->attach(
            $mentor,
            $student,
            $findAttachMentorStudentRequest->firstname,
            $findAttachMentorStudentRequest->lastname
        );
    }

    public function detachStudent(Mentor $mentor, Student $student, AttachStudentToMentorService $attacheStudentToMentorService): Response
    {
        $user = Auth::user();
        $this->permissionAndRoleService->canPlanMySchedulesOrAbort($user->student);

        $attacheStudentToMentorService->detach($mentor, $student);

        return response()->noContent();
    }

    public function getByEventoId(Request $request)
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return $this->mentorService->getByEventoPersonId($request->eventoId);
    }
}
