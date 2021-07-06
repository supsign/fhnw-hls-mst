<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $assessment = Assessment::create([
            'course_id' => 1,
            'study_field_id' => 13,
            'start_semester_id' => 1
        ]);

        var_dump(
            $assessment->studyField()->first(),
            $assessment->studyField()->first()->id === $assessment->id
        );


        return view('welcome');
    }
}
