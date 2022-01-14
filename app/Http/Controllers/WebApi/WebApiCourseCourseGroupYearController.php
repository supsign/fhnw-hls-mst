<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseCourseGroupYear\PostCourseCourseGroupYearRequest;
use App\Models\Course;
use App\Models\CourseCourseGroupYear;
use App\Models\CourseGroupYear;
use App\Services\Course\CourseService;
use App\Services\CourseCourseGroupYear\CourseCourseGroupYearService;
use App\Services\CourseGroupYear\CourseGroupYearService;
use App\Services\User\PermissionAndRoleService;

class WebApiCourseCourseGroupYearController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
    ) {
    }

    public function post(
        PostCourseCourseGroupYearRequest $postCourseCourseGroupYearRequest,
        CourseService $courseService,
        CourseGroupYearService $courseGroupYearService,
        CourseCourseGroupYearService $courseCourseGroupYearService
    ): CourseCourseGroupYear {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        /* @var $course Course */
        $course = $courseService->getById($postCourseCourseGroupYearRequest->input('course_id'));

        /* @var $courseGroupYear CourseGroupYear */
        $courseGroupYear = $courseGroupYearService->getById(
            $postCourseCourseGroupYearRequest->get('course_group_year_id')
        );

        if (!$course || !$courseGroupYear) {
            abort(404);
        }

        return $courseCourseGroupYearService->add($course, $courseGroupYear);
    }

    public function delete(CourseCourseGroupYear $courseCourseGroupYear, CourseCourseGroupYearService $courseCourseGroupYearService): void
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $courseCourseGroupYearService->remove($courseCourseGroupYear);
    }
}
