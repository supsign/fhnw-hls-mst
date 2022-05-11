<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseYear\PatchRequest;
use App\Models\CourseYear;
use App\Services\CourseYear\CourseYearService;
use App\Services\User\PermissionAndRoleService;

class CourseYearController extends Controller
{
    public function __construct(
        protected CourseYearService $courseYearService,
        protected PermissionAndRoleService $permissionAndRoleService,
    ) {
    }

    public function patch(CourseYear $course, PatchRequest $request)
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return $this->courseService->patch($course, $request);
    }
}
