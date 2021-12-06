<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Services\Planning\LockPlanningService;
use App\Services\User\PermissionAndRoleService;

class WebApiPlanningController extends Controller
{
    public function __construct(private PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function lock(Planning $planning, LockPlanningService $lockPlanningService)
    {
        $this->permissionAndRoleService->canPlanStudentSchedulesOrAbort($planning->student, $planning);
        return $lockPlanningService->lock($planning);
    }

    public function unLock(Planning $planning, LockPlanningService $lockPlanningService)
    {
        $this->permissionAndRoleService->canPlanStudentSchedulesOrAbort($planning->student, $planning);
        return $lockPlanningService->lock($planning);
    }
}
