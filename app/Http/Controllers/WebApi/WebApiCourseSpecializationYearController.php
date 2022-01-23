<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseSpecializationYear\PostCourseSpecializationYearRequest;
use App\Models\Course;
use App\Models\CourseSpecializationYear;
use App\Models\SpecializationYear;
use App\Services\Course\CourseService;
use App\Services\CourseSpecializationYear\CourseSpecializationYearSerivce;
use App\Services\SpecializationYear\SpecializationYearService;
use App\Services\User\PermissionAndRoleService;

class WebApiCourseSpecializationYearController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
    ) {
    }

    public function post(
        PostCourseSpecializationYearRequest $postCourseSpecializationYearRequest,
        CourseService $courseService,
        SpecializationYearService $specializationYearService,
        CourseSpecializationYearSerivce $courseSpecializationYearSerivce
    ): CourseSpecializationYear {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        /* @var $course Course */
        $course = $courseService->getById($postCourseSpecializationYearRequest->input('course_id'));

        /* @var $specializationYear SpecializationYear */
        $specializationYear = $specializationYearService->getById(
            $postCourseSpecializationYearRequest->get('specialization_year_id')
        );

        if (!$course || !$specializationYear) {
            abort(404);
        }

        return $courseSpecializationYearSerivce->add($course, $specializationYear);
    }

    public function delete(CourseSpecializationYear $courseSpecializationYear, CourseSpecializationYearSerivce $courseSpecializationYearSerivce): void
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $courseSpecializationYearSerivce->remove($courseSpecializationYear);
    }
}
