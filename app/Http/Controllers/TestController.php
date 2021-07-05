<?php

namespace App\Http\Controllers;

use App\Importers\CourseCourseGroupImporter;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        return view('welcome');
    }
}
