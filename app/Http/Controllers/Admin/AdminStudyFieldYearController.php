<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudyFieldYear;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Contracts\View\View;

class AdminStudyFieldYearController extends Controller
{
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function show(StudyFieldYear $studyFieldYear): View
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return view('admin.study-field-year', ['studyFieldYear' => $studyFieldYear]);
    }

    public function courseGroups(StudyFieldYear $studyFieldYear): View
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        $courseGroupYears = $studyFieldYear->courseGroupYears;
        $courseGroups = $courseGroupYears->pluck('courseGroup')->unique();
        $courseCourseGroupYears = $courseGroupYears->pluck('courseCourseGroupYears')->flatten(1)->unique();
        $courses = $courseCourseGroupYears->pluck('course')->unique()->values();

        return view('admin.course-groups', [
            'studyFieldYear' => $studyFieldYear,
            'courseGroups' => $courseGroups,
            'courseGroupYears' => $courseGroupYears,
            'courseCourseGroupYears' => $courseCourseGroupYears,
            'courses' => $courses,
        ]);
    }
}
