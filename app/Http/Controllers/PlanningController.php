<?php

namespace App\Http\Controllers;

use App\Models\Planning;
use App\Models\Semester;
use App\Models\StudyField;
use App\Models\StudyProgram;
use App\Services\Planning\PlanningService;
use App\Services\Semester\SemesterService;
use App\Services\StudyField\StudyFieldService;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Http\Request;

class PlanningController extends Controller
{
    public function __construct(private PermissionAndRoleService $permissionAndRoleService,
                                protected StudyFieldService $studyFieldService,
                                protected SemesterService $semesterService,
                                protected PlanningService $planningService
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

    public function store(Request $request, Planning $planning)
    {
        // Todo in der Datenbank speichern
        $this->permissionAndRoleService->canPlanScheduleOrAbort();
        $studyProgram = $request->studyProgram;
        $studyField = $this->studyFieldService->getById($request->studyField)->name;
        $semester = $this->semesterService->getById($request->semester)->year;

        // $this->planningService->update($planning, $request->validated());

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

    public function delete(PlanningService $planningService, Planning $planning)
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();
        $planningService->delete($planning);

        return  redirect()->route('home');
    }
}
