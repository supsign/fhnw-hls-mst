<?php

namespace App\Http\Controllers;

use App\Importers\TestImporter;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        var_dump(
            new TestImporter
        );

        return view('welcome');
    }
}
