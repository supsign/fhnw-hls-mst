<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\PatchRequest;
use App\Models\Course;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function __construct(private PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function patch(Course $course, PatchRequest $request)
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
    }
}
