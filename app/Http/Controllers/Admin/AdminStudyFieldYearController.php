<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
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
        $mentors = Mentor::orderBy('lastname')->get();

        return view('admin.study-field-year', ['studyFieldYear' => $studyFieldYear]);
    }
}
