<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Models\Planning;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Http\Request;

class WebApiPlanningController extends Controller
{
    public function __construct(private PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function setLock(Request $request, Planning $planning)
    {
        $this->permissionAndRoleService->canPlanStudentSchedulesOrAbort($planning->student, $planning);
    }
}
