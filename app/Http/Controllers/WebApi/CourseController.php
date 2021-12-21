<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\PatchCourseRequest;
use App\Http\Requests\Course\SearchCourseRequest;
use App\Models\Course;
use App\Services\Course\CourseService;
use App\Services\User\PermissionAndRoleService;

class CourseController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
        protected CourseService            $courseService,
    )
    {
    }

    public function patch(Course $course, PatchCourseRequest $request)
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return $this->courseService->setSemesterType($course, $request->is_hs, $request->is_fs);
    }

    public function search(SearchCourseRequest $searchCourseRequest)
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        return $this->courseService->search($searchCourseRequest->search);
    }
}
