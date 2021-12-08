<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\User\PermissionAndRoleService;
use App\Services\User\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminRolesController extends Controller
{
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService, protected UserService $userService)
    {
    }

    public function assignRoles(): View
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return view('admin.assign-roles', [
            'roles' => Role::where('name', '<>', 'server-admin')->get(),
        ]);
    }

    public function assignRoleToUser(Request $request)
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $user = $this->userService->getById($request->user_id);
        $role = $this->permissionAndRoleService->getRoleById($request->role_id);
        $method = 'assign'.str_replace('-', '', $role->name);

        if ($user && $role && method_exists($this->permissionAndRoleService, $method)) {
            $this->permissionAndRoleService->$method($user);
        }
        // Todo: Fehler werfen/Log schreiben?

        return redirect()->route('admin.dashboard');
    }

    public function removeRoleFromUser(Request $request)
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        $user = $this->userService->getById($request->user_id);
        $role = $this->permissionAndRoleService->getRoleById($request->role_id);
        $method = 'remove'.str_replace('-', '', $role->name);

        if ($user && $role && method_exists($this->permissionAndRoleService, $method)) {
            $this->permissionAndRoleService->$method($user);
        }
        // Todo: Fehler werfen/Log schreiben?

        return redirect()->route('admin.dashboard');
    }
}
