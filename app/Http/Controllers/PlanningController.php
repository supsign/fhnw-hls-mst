<?php

namespace App\Http\Controllers;

use App\Models\Planning;
use App\Services\User\PermissionAndRoleService;
use Spatie\Permission\Models\Role;

class PlanningController extends Controller
{
    public function __construct(private PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function create()
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        return view('planning.new', [
            'roles' => Role::all(),
        ]);
    }

    public function store()
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        return redirect()->route('home');
    }

    public function show(Planning $planning)
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        return view('planning.list', ['planning' => $planning]);
    }
}
