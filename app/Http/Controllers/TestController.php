<?php

namespace App\Http\Controllers;

use App\Importers\CourseImporter;
use App\Importers\CourseGroupImporter;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        (new CourseImporter)
            ->setDirectory(storage_path().'/app/')
            ->setFileName('modul.csv')
            ->import();

        return view('welcome');
    }
}
