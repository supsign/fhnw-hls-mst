<?php

namespace App\Http\Controllers;

use App\Services\User\PermissionService;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(private PermissionService $permissionService)
    {
    }

    public function index(Request $request)
    {
        $this->permissionService->canShowAppOrAbort();

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
