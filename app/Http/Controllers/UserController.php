<?php

namespace App\Http\Controllers;

use App\Services\User\PermissionService;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function __construct(private PermissionService $permissionService)
    {
    }

    public function index(): View
    {
        $this->permissionService->canShowAppOrAbort();

        return view('user.index');
    }

}
