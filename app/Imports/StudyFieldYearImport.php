<?php

namespace App\Imports;

use App\Models\StudyFieldYear;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudyFieldYearImport extends BaseImport implements ToModel, WithHeadingRow
{
    protected $requiredFields = ['id_anlass', 'anlassnummer', 'anlassbezeichnung', 'id_anlass_stdg', 'anlassnummer_stdg'];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if ($this->hasRequiredFields($row)) {
            //  Throw error? Write log?
            return;
        }

        var_dump($row);

        return;

        StudyFieldYear::updateOrCreate(
            ['evento_id' => $row['id_anlass']], 
            ['evento_number' => $row['anlassnummer']],
        );
    }
}
