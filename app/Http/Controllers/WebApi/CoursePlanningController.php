<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CoursePlanning\PatchCoursePlanningRequest;
use App\Http\Requests\CoursePlanning\PostRequest;
use App\Models\Course;
use App\Models\CoursePlanning;
use App\Models\Planning;
use App\Models\Semester;
use App\Services\Course\CourseService;
use App\Services\Planning\CoursePlanningService;
use App\Services\Planning\PlanningService;
use App\Services\Semester\SemesterService;
use App\Services\User\PermissionAndRoleService;

class CoursePlanningController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
        protected CoursePlanningService $coursePlanningService,
    ) {
    }

    public function delete(CoursePlanning $coursePlanning)
    {
        $planning = $coursePlanning->planning;
        $student = $planning->student;
        $this->permissionAndRoleService->canPlanScheduleOrAbort($student, $planning);

        if ($planning->is_locked) {
            $this->permissionAndRoleService->canPlanStudentSchedulesOrAbort($student, $planning);
        }

        $this->coursePlanningService->delete($coursePlanning);
    }

    public function post(PostRequest $request, PlanningService $planningService, CourseService $courseService, SemesterService $semesterService)
    {
        /* @var $planning Planning */
        $planning = $planningService->getById($request->planning_id);

        $student = $planning->student;
        $this->permissionAndRoleService->canPlanScheduleOrAbort($student, $planning);

        if ($planning->is_locked) {
            $this->permissionAndRoleService->canPlanStudentSchedulesOrAbort($student, $planning);
        }

        /* @var $course Course */
        $course = $courseService->getById($request->course_id);

        /* @var $semester Semester */
        $semester = $semesterService->getById($request->semester_id);

        if (!$planning || !$course || !$semester) {
            abort(404);
        }

        if (!$semesterService->getSemesterEligibleForPlanning()->contains($semester)) {
            abort(404);
        }

        return $this->coursePlanningService->planCourse($planning, $course, $semester);
    }

    public function patch(PatchCoursePlanningRequest $request, CoursePlanning $coursePlanning, SemesterService $semesterService)
    {
        $planning = $coursePlanning->planning;
        $student = $planning->student;
        $this->permissionAndRoleService->canPlanScheduleOrAbort($student, $planning);

        if ($planning->is_locked) {
            $this->permissionAndRoleService->canPlanStudentSchedulesOrAbort($student, $planning);
        }

        /* @var $semester Semester */
        $semester = $semesterService->getById($request->semester_id);

        if (!$semester) {
            abort(404);
        }

        return $this->coursePlanningService->reschedule($coursePlanning, $semester);
    }

    public function getById(CoursePlanning $coursePlanning)
    {
        $planning = $coursePlanning->planning;
        $student = $planning->student;
        $this->permissionAndRoleService->canPlanScheduleOrAbort($student, $planning);

        return $coursePlanning;
    }
}
