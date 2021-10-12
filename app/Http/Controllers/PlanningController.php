<?php

namespace App\Http\Controllers;

use App\Http\Requests\Planning\StoreRequest;
use App\Models\Planning;
use App\Models\Semester;
use App\Models\StudyField;
use App\Models\StudyProgram;
use App\Services\Planning\PlanningService;
use App\Services\StudyFieldYear\StudyFieldYearService;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Support\Facades\Auth;

class PlanningController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
        protected PlanningService $planningService,
        protected StudyFieldYearService $studyFieldYearService,
    ) {
    }

    public function create()
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        return view('planning.new', [
            'studyFields' => StudyField::where('study_program_id', 6)->get(),
            'studyPrograms' => StudyProgram::where('id', 6)->get(),
            'semesters' => Semester::where('is_hs', true)->get(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        $studyFieldYear = $this->studyFieldYearService->getByStudyFieldIdAndSemesterId(
            $request->studyField,
            $request->semester,
        );

        if (!$studyFieldYear) {
            //  Todo: Swal Einbauen
            return redirect()->route('planning.create');
        }

        $this->planningService->createEmptyPlanning(
            Auth::user()->student->id,
            $studyFieldYear->id,
        );

        return redirect()->route('home');
    }

    public function showOne(Planning $planning)
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();
        $viewParameter = [
            'planning' => $planning,
            'courseGroupYears' => $planning->studyFieldYear->courseGroupYears,
        ];

        return view('planning.showOne', $viewParameter);
    }
}
