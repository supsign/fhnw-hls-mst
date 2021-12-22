<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Http\Requests\CrossQualificationYear\PatchCrossQualificationYearRequest;
use App\Models\CrossQualificationYear;
use App\Services\CrossQualificationYear\CrossQualificationYearService;
use App\Services\User\PermissionAndRoleService;

class WebApiCrossQualificationYearController extends Controller
{
    public function __construct(
        protected PermissionAndRoleService $permissionAndRoleService,
    ) {
    }

    public function patch(
        PatchCrossQualificationYearRequest $patchCrossQualificationYearRequest,
        CrossQualificationYear $crossQualificationYear,
        CrossQualificationYearService $crossQualificationYearService
    ): CrossQualificationYear {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return $crossQualificationYearService
            ->patchAmountToPass(
                $crossQualificationYear,
                $patchCrossQualificationYearRequest->input('amount_to_pass')
            );
    }
}
