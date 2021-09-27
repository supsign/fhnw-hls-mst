<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function showAllSchedules()
    {
        if (!Auth::check()) {
            abort(403);
        }

        return view('schedule.list', ['schedules' => Schedule::all()]);
    }

    public function newSchedule()
    {
        if (!Auth::check()) {
            abort(403);
        }

        return view('schedule.new');
    }

    public function getById(Schedule $schedule)
    {
        if (!Auth::check()) {
            abort(403);
        }

        return view('schedule.list', ['schedule' => $schedule]);
    }
}
