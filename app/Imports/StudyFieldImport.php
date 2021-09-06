<?php

namespace App\Imports;

use App\Models\StudyField;
use Maatwebsite\Excel\Concerns\ToModel;

/*
usage:
use Maatwebsite\Excel\Excel;    (injectable)
use App\Imports\StudyFieldImport;

$excel->import(new StudyFieldImport, 'Tab1_Studiengang.xlsx');
*/

class StudyFieldImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row): void
    {
        if (!is_int($row[0])) {
            return;
        }

        $studyField = StudyField::updateOrCreate(
            ['evento_id' => $row[0]], 
            ['evento_number' => $row[1]],
        );

        if (!$studyField->name) {
            $studyField->name = $row[2];
            $studyField->save();
        }
    }
}
