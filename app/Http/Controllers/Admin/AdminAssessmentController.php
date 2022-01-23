<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assessment;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Contracts\View\View;

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
}
