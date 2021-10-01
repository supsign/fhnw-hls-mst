<?php

namespace App\Http\Controllers;

use App\Services\User\PermissionService;
use App\Services\User\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function __construct(protected PermissionService $permissionService, protected UserService $userService)
    {
    }

    public function dashboard(): View
    {
        $this->permissionService->canManageBackendOrAbort();

        return view('admin.dashboard');
    }

    public function assignRoleToUser(Request $request)
    {
        $this->permissionService->canManageBackendOrAbort();
        $user = $this->userService->getById($request->user_id);
        $role = $this->permissionService->getRoleById($request->role_id);
        $method = 'assign'.str_replace('-', '', $role->name);

        if ($user && $role && method_exists($this->permissionService, $method)) {
            $this->permissionService->$method($user);
        }
        // Todo: Fehler werfen/Log schreiben?

        return redirect()->route('admin.dashboard');
    }

    public function removeRoleFromUser(Request $request)
    {
        $this->permissionService->canManageBackendOrAbort();
        $user = $this->userService->getById($request->user_id);
        $role = $this->permissionService->getRoleById($request->role_id);
        $method = 'remove'.str_replace('-', '', $role->name);

        if ($user && $role && method_exists($this->permissionService, $method)) {
            $this->permissionService->$method($user);
        }
        // Todo: Fehler werfen/Log schreiben?

        return redirect()->route('admin.dashboard');
    }
}
