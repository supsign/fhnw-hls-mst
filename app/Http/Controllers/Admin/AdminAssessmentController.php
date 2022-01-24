<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Services\Assessment\CopyAssessmentService;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class AdminAssessmentController extends Controller
{
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function showOne(Assessment $assessment): View
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return view('admin.assessment', ['assessment' => $assessment]);
    }

    public function copy(Assessment $assessment, CopyAssessmentService $copyAssessmentService): Application|RedirectResponse|Redirector
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        $newAssessment = $copyAssessmentService->execute($assessment);

        return redirect(route('admin.assessments.showOne', [$newAssessment]));
    }
}
