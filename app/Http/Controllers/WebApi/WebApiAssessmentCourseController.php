<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssessmentCourse\PostAssessmentCourseRequest;
use App\Models\Assessment;
use App\Models\AssessmentCourse;
use App\Models\Course;
use App\Services\Assessment\AssessmentCourseService;
use App\Services\Assessment\AssessmentService;
use App\Services\Course\CourseService;
use App\Services\User\PermissionAndRoleService;

class WebApiAssessmentCourseController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
    ) {
    }

    public function post(
        PostAssessmentCourseRequest $postAssessmentCourseRequest,
        CourseService $courseService,
        AssessmentService $assessmentService,
        AssessmentCourseService $assessmentCourseService
    ): AssessmentCourse {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        /* @var $course Course */
        $course = $courseService->getById($postAssessmentCourseRequest->input('course_id'));

        /* @var $assessment Assessment */
        $assessment = $assessmentService->getById(
            $postAssessmentCourseRequest->get('assessment_id')
        );

        if (!$course || !$assessment) {
            abort(404);
        }

        return $assessmentCourseService->attach($assessment, $course);
    }

    public function delete(AssessmentCourse $assessmentCourse, AssessmentCourseService $assessmentCourseService): void
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $assessmentCourseService->remove($assessmentCourse);
    }
}
