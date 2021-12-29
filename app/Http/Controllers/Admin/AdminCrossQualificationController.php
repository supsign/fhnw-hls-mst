<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrossQualificationYear;
use App\Services\User\PermissionAndRoleService;
use App\Services\User\UserService;
use Illuminate\Contracts\View\View;

class AdminCrossQualificationController extends Controller
{
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService, protected UserService $userService)
    {
    }

    public function showCrossQualificationYaer(CrossQualificationYear $crossQualificationYear): View
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return view('admin.cross-qualification-year', [
            'crossQualificationYear' => $crossQualificationYear,
        ]);
    }
}
