<?php

namespace App\Http\Controllers;

use App\Services\User\PermissionService;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    public function __construct(private PermissionService $permissionService)
    {
    }

    public function dashboard(): View
    {
        $this->permissionService->canManageBackendOrAbort();

        return view('admin.dashboard');
    }
}
