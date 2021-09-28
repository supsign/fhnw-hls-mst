<?php

namespace App\Http\Controllers;

use App\Imports\StudyFieldImport;
use App\Imports\StudyFieldYearImport;
use Maatwebsite\Excel\Excel;

class TestController extends Controller
{
    public function test(Excel $excel)
    {
        $excel->import(new StudyFieldImport, 'Tab1_Studiengang.xlsx');
        $excel->import(new StudyFieldYearImport(), 'Tab2_Studienjahrgang.xlsx');

        echo 'done';
    }
}
