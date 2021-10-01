<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Services\User\PermissionAndRoleService;
use Spatie\Permission\Models\Role;

class ScheduleController extends Controller
{
    public function __construct(private PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function index()
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        return view('schedule.list');
    }

    public function create()
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        return view('schedule.new', [
            'roles' => Role::all(),
        ]);
    }

    public function store()
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        return redirect()->route('home');
    }

    public function show(Schedule $schedule)
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        return view('schedule.list', ['schedule' => $schedule]);
    }
}
