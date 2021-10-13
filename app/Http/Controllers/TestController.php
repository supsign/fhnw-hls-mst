<?php

namespace App\Http\Controllers;

use App\Imports\CourseExcelImport;
use Maatwebsite\Excel\Excel;

class TestController extends Controller
{
    public function test(Excel $excel)
    {
        $excel->import(new CourseExcelImport, 'Tab3_Modul.xlsx');
    }
}
