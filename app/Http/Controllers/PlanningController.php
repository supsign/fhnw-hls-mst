<?php

namespace App\Http\Controllers;

use App\Http\Requests\Planning\StoreRequest;
use App\Models\Planning;
use App\Models\Semester;
use App\Models\StudyField;
use App\Models\StudyProgram;
use App\Services\Planning\PlanningService;
use App\Services\Semester\SemesterService;
use App\Services\StudyField\StudyFieldService;
use App\Services\StudyFieldYear\StudyFieldYearService;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Support\Facades\Auth;

class PlanningController extends Controller
{
    public function __construct(
        private PermissionAndRoleService $permissionAndRoleService,
        protected StudyFieldService $studyFieldService,
        protected SemesterService $semesterService,
        protected PlanningService $planningService,
        protected StudyFieldYearService $studyFieldYearService,
    ) {
    }

    public function create()
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();
        $user = Auth::user();

        $hlsBachelorStudyProgram = StudyProgram::find(6);

        $studyField = $user->student->studyFieldYear->studyField ?? null;
        $semester = $user->student->studyFieldYear->beginSemester ?? null;
        $studyProgram = $user->student->studyFieldYear->studyField->studyProgram ?? null;

        if (!$studyProgram) {
            $studyProgram = $hlsBachelorStudyProgram;
        }

        // Im Moment Tool nur Bachelor HLS
        if ($studyProgram->id !== $hlsBachelorStudyProgram->id) {
            $studyField = null;
            $semester = null;
            $studyProgram = $hlsBachelorStudyProgram;
        }

        return view('planning.new', [
            'studyFields' => StudyField::where('study_program_id', 6)->get(),
            'studyPrograms' => StudyProgram::all(),
            'semesters' => Semester::where('is_hs', true)->get(),
            'studyField' => $studyField,
            'semester' => $semester,
            'studyProgram' => $studyProgram,
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

        $planning = $this->planningService->createEmptyPlanning(
            Auth::user()->student->id,
            $studyFieldYear->id,
        );

        return redirect()->route('planning.showOne', $planning);
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
        $planningService->cascadingDelete($planning);

        return redirect()->route('home');
    }
}
