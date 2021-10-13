<?php

namespace App\Http\Controllers;

use App\Services\User\PermissionAndRoleService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(protected PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function index(Request $request)
    {
        $this->permissionAndRoleService->canShowAppOrAbort();

        return view('pages.home');
    }
}
