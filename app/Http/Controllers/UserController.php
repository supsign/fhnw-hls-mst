<?php

namespace App\Http\Controllers;

use App\Services\User\PermissionAndRoleService;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function __construct(private PermissionAndRoleService $permissionAndRoleService)
    {
    }

//    public function index(): View
//    {
//        $this->permissionAndRoleService->canShowAppOrAbort();
//
//        return view('user.index');
//    }
}
