<?php

namespace App\Http\Controllers;

use App\Imports\CrossQualificationImport;

class TestController extends Controller
{
    public function test()
    {
        (new CrossQualificationImport)->import();
    }
}
