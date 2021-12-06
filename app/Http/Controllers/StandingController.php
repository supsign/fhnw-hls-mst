<?php

namespace App\Http\Controllers;

use App\Services\Planning\PlanningService;
use App\Services\Semester\SemesterService;
use App\Services\StudyField\StudyFieldService;
use App\Services\StudyFieldYear\StudyFieldYearService;
use App\Services\User\PermissionAndRoleService;
use Auth;

class StandingController extends Controller
{
    public function __construct(
        private PermissionAndRoleService $permissionAndRoleService,
        protected StudyFieldService      $studyFieldService,
        protected SemesterService        $semesterService,
        protected PlanningService        $planningService,
        protected StudyFieldYearService  $studyFieldYearService,
    )
    {
    }

    public function index()
    {
        $this->permissionAndRoleService->canShowAppOrAbort();

        $user = Auth::user();

        $student = $user->student;

        if (!$student) {
            abort(403, __('l.noAccess'));
        }

        if (!$student->studyFieldYear) {
            // ToDO Alert bringen
            redirect(route('home'));
        }


        return view('pages.standing', ['student' => $student]);
    }
}
