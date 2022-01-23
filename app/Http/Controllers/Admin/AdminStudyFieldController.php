<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Models\StudyField;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Contracts\View\View;

class AdminStudyFieldController extends Controller
{
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function showAll(): View
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        $allStudyFields = StudyField::all();
        $studyFields = $allStudyFields->filter(function (StudyField $studyField) {
            return $studyField->studyFieldYears()->count();
        });
        $assessments = Assessment::all();

        return view('admin.study-fields', [
            'studyFields' => $studyFields,
            'assessments' => $assessments
        ]);
    }
}
