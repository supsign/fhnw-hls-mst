<?php

namespace App\Http\Controllers;

use App\Http\Requests\Planning\StoreRequest;
use App\Models\CrossQualification;
use App\Models\Planning;
use App\Models\Semester;
use App\Models\Specialization;
use App\Models\StudyField;
use App\Models\StudyFieldYear;
use App\Models\StudyProgram;
use App\Services\CrossQualification\CrossQualificationService;
use App\Services\CrossQualificationYear\CrossQualificationYearService;
use App\Services\Planning\FillPlanningWithRecommendationsService;
use App\Services\Planning\PlanningService;
use App\Services\Semester\SemesterService;
use App\Services\Specialization\SpecializationService;
use App\Services\SpecializationYear\SpecializationYearService;
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

    public function copy(Planning $planning)
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        return view('planning.new', [
            'studyFields' => StudyField::where('study_program_id', 6)->get(),
            'studyPrograms' => StudyProgram::all(),
            'studyFieldYears' => StudyFieldYear::all(),
            'semesters' => Semester::where('is_hs', true)->get(),
            'student' => $planning->student,
            'specializations' => Specialization::all(),
            'crossQualifications' => CrossQualification::all(),
            'mentorStudent' => null,
            'planning' => $planning,
        ]);
    }

    public function create()
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();
        $user = Auth::user();

        return view('planning.new', [
            'studyFields' => StudyField::where('study_program_id', 6)->get(),
            'studyPrograms' => StudyProgram::all(),
            'studyFieldYears' => StudyFieldYear::all(),
            'semesters' => Semester::where('is_hs', true)->get(),
            'student' => $user->student,
            'specializations' => Specialization::all(),
            'crossQualifications' => CrossQualification::all(),
            'mentorStudent' => null,
        ]);
    }

    public function print(Planning $planning)
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        $firstname = Auth::user()->firstname;
        $lastname = Auth::user()->lastname;
        $pdf = app('dompdf.wrapper');
        $pdf->setPaper('A4', 'portrait');
        $pdf->getDomPDF()->set_option('enable_php', true);
        $pdf->loadView('planning.print', ['planning' => $planning, 'firstname' => $firstname, 'lastname' => $lastname]);

        return $pdf->stream();
    }

    public function store(
        StoreRequest $request,
        SpecializationService $specializationService,
        CrossQualificationService $crossQualificationService,
    ) {
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
            Auth::user()->student,
            $studyFieldYear,
            $crossQualificationService->getById($request->crossQualification),
            $specializationService->getById($request->specialization),
        );

        return redirect()->route('planning.showOne', $planning);
    }

    public function storeCopy(
        StoreRequest $request,
        Planning $planning,
        SpecializationService $specializationService,
        CrossQualificationService $crossQualificationService,
    ) {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        $studyFieldYear = $this->studyFieldYearService->getByStudyFieldIdAndSemesterId(
            $request->studyField,
            $request->semester,
        );

        if (!$studyFieldYear) {
            //  Todo: Swal Einbauen
            return redirect()->route('planning.create');
        }

        $newPlanning = $this->planningService->copy(
            $planning, 
            $studyFieldYear,
            $crossQualificationService->getById($request->crossQualification),
            $specializationService->getById($request->specialization),
        );

        return redirect()->route('planning.showOne', $newPlanning);
    }

    public function showOne(Planning $planning)
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        $viewParameter = [
            'planning' => $planning,
            'courseGroupYears' => $planning->studyFieldYear->courseGroupYears,
            'mentorStudent' => null,
        ];

        return view('planning.showOne', $viewParameter);
    }

    public function delete(PlanningService $planningService, Planning $planning)
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();
        $planningService->cascadingDelete($planning);

        return redirect()->route('home');
    }

    public function setRecommendations(Planning $planning, FillPlanningWithRecommendationsService $fillPlanningWithRecommendationsService)
    {
        $this->permissionAndRoleService->canPlanScheduleOrAbort();

        $fillPlanningWithRecommendationsService->fill($planning);

        return redirect()->route('planning.showOne', $planning);
    }
}
