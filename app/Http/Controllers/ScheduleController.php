<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Services\User\PermissionService;

class ScheduleController extends Controller
{
    public function __construct(private PermissionService $permissionService)
    {
    }

    public function index()
    {
        $this->permissionService->canPlanScheduleOrAbort();

        return view('schedule.list');
    }

    public function create()
    {
        $this->permissionService->canPlanScheduleOrAbort();

<<<<<<< HEAD
        return view('schedule.new');
=======
        return view('schedule.new', [
            'roles' => Role::all(),
        ]);
>>>>>>> 286e7a210a072cea5d3b8a38e87e8a362c0480bd
    }

    public function store()
    {
        $this->permissionService->canPlanScheduleOrAbort();

        return redirect()->route('home');
    }

    public function show(Schedule $schedule)
    {
        $this->permissionService->canPlanScheduleOrAbort();

        return view('schedule.list', ['schedule' => $schedule]);
    }
}
