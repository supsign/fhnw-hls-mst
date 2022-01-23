<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseGroupYear\PatchCourseGroupYearRequest;
use App\Models\CourseGroupYear;
use App\Services\CourseGroupYear\CourseGroupYearService;
use App\Services\User\PermissionAndRoleService;

class WebApiCourseGroupYearController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
    ) {
    }

    public function get(CourseGroupYear $courseGroupYear): CourseGroupYear
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return $courseGroupYear;
    }

    public function patch(PatchCourseGroupYearRequest $patchCourseGroupYearRequest, CourseGroupYear $courseGroupYear, CourseGroupYearService $courseGroupYearService): CourseGroupYear
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $courseGroupYearService->setCreditToPass($courseGroupYear, $patchCourseGroupYearRequest->credits_to_pass);

        return $courseGroupYear;
    }
}
