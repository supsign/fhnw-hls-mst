<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Services\User\PermissionAndRoleService;
use Spatie\Permission\Models\Role;

class ScheduleController extends Controller
{
    public function __construct(private PermissionAndRoleService $PermissionAndRoleService)
    {
    }

    public function index()
    {
        $this->PermissionAndRoleService->canPlanScheduleOrAbort();

        return view('schedule.list');
    }

    public function create()
    {
        $this->PermissionAndRoleService->canPlanScheduleOrAbort();

        return view('schedule.new', [
            'roles' => Role::all(),
        ]);
    }

    public function store()
    {
        $this->PermissionAndRoleService->canPlanScheduleOrAbort();

        return redirect()->route('home');
    }

    public function show(Schedule $schedule)
    {
        $this->PermissionAndRoleService->canPlanScheduleOrAbort();

        return view('schedule.list', ['schedule' => $schedule]);
    }
}
