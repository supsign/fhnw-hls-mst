<?php

namespace App\Http\Controllers;

use App\Imports\CompletionImport;
use Maatwebsite\Excel\Excel;

class TestController extends Controller
{
    public function test(Excel $excel)
    {
        $excel->import(new CompletionImport, 'Tab6_AnmMA.xlsx');
    }
}
