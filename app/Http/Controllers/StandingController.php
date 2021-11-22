<?php

namespace App\Http\Controllers;

use App\Services\Planning\PlanningService;
use App\Services\Semester\SemesterService;
use App\Services\StudyField\StudyFieldService;
use App\Services\StudyFieldYear\StudyFieldYearService;
use App\Services\User\PermissionAndRoleService;
use Auth;
use Carbon\Carbon;

class StandingController extends Controller
{
    public function __construct(
        private PermissionAndRoleService $permissionAndRoleService,
        protected StudyFieldService $studyFieldService,
        protected SemesterService $semesterService,
        protected PlanningService $planningService,
        protected StudyFieldYearService $studyFieldYearService,
    ) {
    }


    public function index()
    {
        $this->permissionAndRoleService->canShowAppOrAbort();

        $user = Auth::user();

        if (!$user->student) {
            abort(403, __('l.noAccess'));
        }

        if (!$user->student->studyFieldYear) {
            // ToDO Alert bringen
            redirect(route('home'));
        }

        $student = $user->student;

        $now = Carbon::now()->format('d.m.Y H:i');


        return view('pages.standing', ['student' => $student, 'now' => $now]);
    }
}