<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $firstname = $request->session()->get('firstname');
        $lastname = $request->session()->get('lastname');
        $email = $request->session()->get('email');
        return view('welcome', ['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email]);
    }
}
