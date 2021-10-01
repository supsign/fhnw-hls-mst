<?php

namespace App\Http\Controllers;

use App\Services\User\PermissionAndRoleService;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function __construct(private PermissionAndRoleService $PermissionAndRoleService)
    {
    }

    public function index(): View
    {
        $this->PermissionAndRoleService->canShowAppOrAbort();

        return view('user.index');
    }
}
