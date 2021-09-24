<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $firstname = $request->session()->get('firstname');
        $lastname = $request->session()->get('lastname');
        $email = $request->session()->get('email');

        return view('home', ['firstname' => $firstname, 'lastname' => $lastname, 'email' => $email]);
    }
}
