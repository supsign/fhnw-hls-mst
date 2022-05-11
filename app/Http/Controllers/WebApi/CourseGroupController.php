<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseGroup\PatchRequest;
use App\Http\Requests\CourseGroup\PostRequest;
use App\Models\CourseGroup;
use App\Services\CourseGroup\CourseGroupService;
use App\Services\User\PermissionAndRoleService;

class CourseGroupController extends Controller
{
    public function __construct(
        protected CourseGroupService $courseGroupService,
        protected PermissionAndRoleService $permissionAndRoleService,
    ) {
    }

    public function patch(CourseGroup $courseGroup, PatchRequest $request): CourseGroup
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        
        return $this->courseGroupService->patch($courseGroup, $request);
    }

    public function post(PostRequest $request): CourseGroup
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        
        return $this->courseGroupService->create($request);
    }
}
