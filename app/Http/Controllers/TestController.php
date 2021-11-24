<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Services\SpecializationYear\SpecializationYearService;

class TestController extends Controller
{
    public function test(SpecializationYearService $specializationYearService)
    {
        $student = Student::find(1);

        var_dump(

        );
    }
}
