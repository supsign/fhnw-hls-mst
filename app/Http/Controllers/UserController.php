<?php

namespace App\Http\Controllers;

use App\Services\User\PermissionAndRoleService;

class UserController extends Controller
{
    public function __construct(private PermissionAndRoleService $permissionAndRoleService)
    {

    }
}
