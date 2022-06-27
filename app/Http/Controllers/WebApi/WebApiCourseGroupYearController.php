<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseGroupYear\PatchRequest;
use App\Http\Requests\CourseGroupYear\PostRequest;
use App\Models\CourseGroupYear;
use App\Services\CourseGroupYear\CourseGroupYearService;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Http\Response;

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

    public function delete(CourseGroupYear $courseGroupYear): Response
    {
        $courseGroupYear->delete();

        return response()->noContent();
    }

    public function patch(CourseGroupYear $courseGroupYear, CourseGroupYearService $courseGroupYearService, PatchRequest $request): CourseGroupYear
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $courseGroupYearService->setCreditToPass($courseGroupYear, $request->credits_to_pass);

        return $courseGroupYear;
    }

    public function post(PostRequest $request, CourseGroupYearService $courseGroupYearService): CourseGroupYear
    {
        return $courseGroupYearService->createFromPostRequest($request);
    }
}
