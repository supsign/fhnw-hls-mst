<?php

namespace App\Imports;

use App\Models\StudyField;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

/*
usage:
use Maatwebsite\Excel\Excel;    (injectable)
use App\Imports\StudyFieldImport;

$excel->import(new StudyFieldImport, 'Tab1_Studiengang.xlsx');
*/

class StudyFieldImport implements ToModel, WithHeadingRow
{
    protected $requiredFields = ['id_anlass', 'anlassnummer', 'anlassbezeichnung'];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row): void
    {
        if (count(array_intersect($this->requiredFields, array_keys($row))) !== count($this->requiredFields)) {
            //  Throw error? Write log?
            return;
        }

        $studyField = StudyField::updateOrCreate(
            ['evento_id' => $row['id_anlass']], 
            ['evento_number' => $row['anlassnummer']],
        );

        if (!$studyField->name) {
            $studyField->name = $row['anlassbezeichnung'];
            $studyField->save();
        }
    }
}
