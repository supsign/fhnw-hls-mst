<?php

namespace App\Http\Controllers;

use App\Services\User\PermissionAndRoleService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(private PermissionAndRoleService $PermissionAndRoleService)
    {
    }

    public function index(Request $request)
    {
        $this->PermissionAndRoleService->canShowAppOrAbort();

        $firstname = $request->session()->get('firstname');
        $lastname = $request->session()->get('lastname');
        $email = $request->session()->get('email');

        return view('pages.home', [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
        ]);
    }
}
