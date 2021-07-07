<?php

namespace App\Http\Controllers;

use App\Importers\SkillPrerequisiteImporter;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        (new SkillPrerequisiteImporter)->import();

        return view('welcome');
    }
}
