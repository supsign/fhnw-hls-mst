<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostMentorStudyFieldRequest;
use App\Models\Mentor;
use App\Models\MentorStudyField;
use App\Models\StudyField;
use App\Services\Mentor\MentorService;
use App\Services\StudyField\StudyFieldService;
use App\Services\User\PermissionAndRoleService;

class WebApiMentorStudyFieldController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
        protected MentorService            $mentorService,
        protected StudyFieldService        $studyFieldService
    )
    {
    }

    public function postMentorStudyField(PostMentorStudyFieldRequest $request): MentorStudyField
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        /* @var $mentor Mentor */
        $mentor = $this->mentorService->getById($request->mentor_id);

        /* @var $studyField StudyField */
        $studyField = $this->studyFieldService->getById($request->study_field_id);
        $isDeputy = $request->is_deputy;

        if (!$mentor || !$studyField) {
            abort(404);
        }

        return $this->mentorService->addStudyField($mentor, $studyField, $isDeputy);
    }

    public function deleteMentorStudyField(MentorStudyField $mentorStudyField): void
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $mentorStudyField->delete();
    }
}
