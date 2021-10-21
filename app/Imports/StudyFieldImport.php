<?php

namespace App\Imports;

use App\Services\StudyField\StudyFieldService;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

/*
usage:
use Maatwebsite\Excel\Excel;    (injectable)
use App\Imports\StudyFieldImport;

$excel->import(new StudyFieldImport, 'Tab1_Studiengang.xlsx');
*/

class StudyFieldImport extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected array $requiredFields = ['id_anlass', 'anlassnummer', 'anlassbezeichnung'];

    public function __construct()
    {
        $this->service = App::make(StudyFieldService::class);
    }

    /**
     * @param  array  $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row): void
    {
        if (!$this->hasRequiredFields($row) || $this->isEmptyRow($row)) {
            //  Throw error? Write log?
            return;
        }

        $studyField = $this->service->createOrUpdateOnEventoId(
            $row['id_anlass'],
            [
                'evento_number' => $row['anlassnummer'],
                'study_program_id' => 6,                    //  Todo: Anhand von 'anlassbezeichnung' mit name comparen?
            ],
        );

        if (!$studyField->name) {
            $this->service->update(
                $studyField,
                [
                    'name' => $row['anlassbezeichnung'],
                ]
            );
        }
    }
}
