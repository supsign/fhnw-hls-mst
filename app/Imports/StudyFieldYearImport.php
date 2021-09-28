<?php

namespace App\Imports;

use App\Services\StudyFieldYear\StudyFieldYearService;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudyFieldYearImport extends BaseImport implements ToModel, WithHeadingRow
{
    protected $requiredFields = ['id_anlass', 'anlassnummer', 'anlassbezeichnung', 'id_anlass_stdg', 'anlassnummer_stdg'];

    public function __construct()
    {}

    /**
     * @param  array  $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!$this->hasRequiredFields($row) || $this->isEmptyRow($row)) {
            //  Throw error? Write log?
            return;
        }

        var_dump($row);

        // App::make(StudyFieldYearService::class)->createOrUpdateOnEventoId(
        //     $row['id_anlass'],
        //     [
        //         'evento_number' => $row['anlassnummer']
        //     ],
        // );
    }
}
