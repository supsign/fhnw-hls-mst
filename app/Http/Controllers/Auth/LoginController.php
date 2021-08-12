<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Services\TokenService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoginController extends Controller
{

    public function login(Request $request, TokenService $tokenService) {
        $jwt = $request->jwt;


        if (!$jwt){
            // oder ein Redeirect??
            abort(403);
        }

        if (!$tokenService->isValid($jwt)) {
            // oder ein Redeirect??
            abort(403);
        }


        $claims = $tokenService->getClaims($jwt);

        Auth::attempt();


    }

}
