<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request, AuthService $authService)
    {
        $jwt = $request->input('jwt');

        if (!$jwt) {
            // oder ein Redeirect??
            abort(403);
        }

        if (!$authService->attempt($jwt)) {
            // oder ein Redeirect??
            abort(403);
        }

        return redirect(route('home'));
    }
}
