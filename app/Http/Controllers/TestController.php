<?php

namespace App\Http\Controllers;

use App\Imports\StudyFieldYearImport;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    public function test(Excel $excel)
    {
        $excel->import(new StudyFieldYearImport, 'Tab2_Studienjahrgang.xlsx');
    }
}
