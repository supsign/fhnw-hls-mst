<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\Assessment\PatchAssessmentRequest;
use App\Models\Assessment;
use App\Services\Assessment\AssessmentService;
use App\Services\User\PermissionAndRoleService;

class WebApiAssessmentController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
    ) {
    }

    public function get(Assessment $assessment): Assessment
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return $assessment;
    }

    public function patch(
        PatchAssessmentRequest $patchAssessmentRequest,
        Assessment $assessment,
        AssessmentService $assessmentService,
    ): Assessment {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $assessmentService->setAmountToPass($assessment, $patchAssessmentRequest->amount_to_pass);

        return $assessment;
    }
}
