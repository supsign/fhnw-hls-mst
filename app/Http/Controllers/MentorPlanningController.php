<?php

namespace App\Http\Controllers;

use App\Http\Requests\Planning\StoreRequest;
use App\Models\CrossQualification;
use App\Models\Planning;
use App\Models\Semester;
use App\Models\Specialization;
use App\Models\Student;
use App\Models\StudyField;
use App\Models\StudyFieldYear;
use App\Models\StudyProgram;
use App\Services\CrossQualification\CrossQualificationService;
use App\Services\Mentor\MentorStudentService;
use App\Services\Planning\FillPlanningWithRecommendationsService;
use App\Services\Planning\PlanningService;
use App\Services\Semester\SemesterService;
use App\Services\Specialization\SpecializationService;
use App\Services\StudyField\StudyFieldService;
use App\Services\StudyFieldYear\StudyFieldYearService;
use App\Services\User\PermissionAndRoleService;
use Auth;

class MentorPlanningController extends Controller
{
    public function __construct(
        private PermissionAndRoleService $permissionAndRoleService,
        protected StudyFieldService $studyFieldService,
        protected SemesterService $semesterService,
        protected PlanningService $planningService,
        protected StudyFieldYearService $studyFieldYearService,
    ) {
    }

    public function create(Student $student, MentorStudentService $mentorStudentService)
    {
        $this->permissionAndRoleService->canPlanStudentSchedulesOrAbort($student);

        $mentorStudent = $mentorStudentService->getByMentorAndStudent(Auth::user()?->mentor, $student);

        if (!$mentorStudent) {
            return redirect()->route('mentor.planning.list', $student);
        }

        return view('planning.new', [
            'studyFields' => StudyField::where('study_program_id', 6)->get(),
            'studyPrograms' => StudyProgram::all(),
            'studyFieldYears' => StudyFieldYear::all(),
            'semesters' => Semester::where('is_hs', true)->get(),
            'student' => $student,
            'specializations' => Specialization::all(),
            'crossQualifications' => CrossQualification::all(),
            'mentorStudent' => $mentorStudent,
        ]);
    }

    public function store(
        StoreRequest $request,
        Student $student,
        SpecializationService $specializationService,
        CrossQualificationService $crossQualificationService,
    ) {
        $this->permissionAndRoleService->canPlanStudentSchedulesOrAbort($student);

        $studyFieldYear = $this->studyFieldYearService->getByStudyFieldIdAndSemesterId(
            $request->studyField,
            $request->semester,
        );

        if (!$studyFieldYear) {
            //  Todo: Swal Einbauen
            return redirect()->route('planning.create');
        }

        $planning = $this->planningService->createEmptyPlanning(
            $student,
            $studyFieldYear,
            $crossQualificationService->getById($request->crossQualification),
            $specializationService->getById($request->specialization),
        );

        return redirect()->route('mentor.planning.showOne', [$student, $planning]);
    }

    public function storeCopy(
        StoreRequest $request,
        Planning $planning,
        SpecializationService $specializationService,
        CrossQualificationService $crossQualificationService,
    ) {
        $this->permissionAndRoleService->canPlanStudentSchedulesOrAbort($planning->student);

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

        return redirect()->route('mentor.planning.showOne', [$newPlanning->student, $newPlanning]);
    }

    public function showOne(Student $student, Planning $planning, MentorStudentService $mentorStudentService)
    {
        $this->permissionAndRoleService->canPlanStudentSchedulesOrAbort($student);

        $mentorStudent = $mentorStudentService->getByMentorAndStudent(Auth::user()?->mentor, $student);

        if (!$mentorStudent) {
            return redirect()->route('mentor.planning.list', $student);
        }

        $viewParameter = [
            'planning' => $planning,
            'courseGroupYears' => $planning->studyFieldYear->courseGroupYears,
            'mentorStudent' => $mentorStudent,
        ];

        return view('planning.showOne', $viewParameter);
    }

    public function delete(Student $student, Planning $planning, PlanningService $planningService)
    {
        $this->permissionAndRoleService->canPlanStudentSchedulesOrAbort($student);
        $planningService->cascadingDelete($planning);

        return redirect()->route('mentor.planning.list', $student);
    }

    public function list(Student $student, MentorStudentService $mentorStudentService)
    {
        $this->permissionAndRoleService->canPlanStudentSchedulesOrAbort($student);

        $plannings = $student->plannings;

        $mentorStudent = $mentorStudentService->getByMentorAndStudent(Auth::user()?->mentor, $student);

        if (!$mentorStudent) {
            return redirect()->route('home');
        }

        return view('pages.student-plannings', ['plannings' => $plannings, 'mentorStudent' => $mentorStudent]);
    }

    public function setRecommendations(Student $student, Planning $planning, FillPlanningWithRecommendationsService $fillPlanningWithRecommendationsService, MentorStudentService $mentorStudentService)
    {
        $this->permissionAndRoleService->canPlanStudentSchedulesOrAbort($student);

        $fillPlanningWithRecommendationsService->fill($planning);

        $mentorStudent = $mentorStudentService->getByMentorAndStudent(Auth::user()?->mentor, $student);

        if (!$mentorStudent) {
            return redirect()->route('home');
        }

        return redirect()->route('mentor.planning.showOne', [$mentorStudent->student, $planning]);
    }
}
