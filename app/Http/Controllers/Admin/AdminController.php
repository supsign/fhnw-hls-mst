<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Services\User\PermissionAndRoleService;
use App\Services\User\UserService;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService, protected UserService $userService)
    {
    }

    public function courses(): View
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return view('admin.courses', [
            'courses' => Course::all()->sortBy('name'),
        ]);
    }

    public function dashboard(): View
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return view('admin.dashboard');
    }
}
