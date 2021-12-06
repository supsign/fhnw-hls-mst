<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Services\User\PermissionAndRoleService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $userService, protected PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function getByEmail(Request $request)
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();

        return $this->userService->getByEmail($request->email);
    }
}
