<?php

namespace App\Http\Controllers;

use App\Models\StudyFieldYear;
use App\Services\StudyFieldYear\StudyFieldYearService;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    public function test(Excel $excel, StudyFieldYearService $studyFieldYearService)
    {
        $sfy = StudyFieldYear::find(4);

        $tets = $studyFieldYearService->updateOrCreate(
            ['id' => $sfy->id],
            ['evento_id' => 5555, 'is_specialization_mandatory' => true, 'id' => 5]
        );

        // var_dump(
        //     $tets
        // );

        // $studyFieldYearService->update($sfy, [
        //     'evento_id' => 1234,
        //     'evento_number' => 5678,
        // ]);

        // $excel->import(new StudyFieldYearImport, 'Tab2_Studienjahrgang.xlsx');
    }
}
