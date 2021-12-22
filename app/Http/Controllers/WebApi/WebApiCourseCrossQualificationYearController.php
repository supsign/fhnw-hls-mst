<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseCrossQualificationYear\PostCourseCrossQualificationYearController;
use App\Models\Course;
use App\Models\CourseCrossQualificationYear;
use App\Models\CrossQualificationYear;
use App\Services\Course\CourseService;
use App\Services\CourseCrossQualificationYear\CourseCrossQualificationYearService;
use App\Services\CrossQualificationYear\CrossQualificationYearService;
use App\Services\User\PermissionAndRoleService;

class WebApiCourseCrossQualificationYearController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
    )
    {
    }

    public function post(
        PostCourseCrossQualificationYearController $postCourseCrossQualificationYearController,
        CourseCrossQualificationYearService        $courseCrossQualificationYearService,
        CourseService                              $courseService,
        CrossQualificationYearService              $crossQualificationYearService
    ): CourseCrossQualificationYear
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        /* @var $course Course */
        $course = $courseService->getById($postCourseCrossQualificationYearController->input('course_id'));

        /* @var $crossQualificationYear CrossQualificationYear */
        $crossQualificationYear = $crossQualificationYearService->getById(
            $postCourseCrossQualificationYearController->get('cross_qualification_year_id')
        );

        if (!$course || !$crossQualificationYear) {
            abort(404);
        }

        return $courseCrossQualificationYearService->add($crossQualificationYear, $course);

    }

    public function delete(CourseCrossQualificationYear $courseCrossQualificationYear, CourseCrossQualificationYearService $courseCrossQualificationYearService): void
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $courseCrossQualificationYearService->remove($courseCrossQualificationYear);
    }


}
