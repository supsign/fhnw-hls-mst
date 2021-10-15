<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected array $requiredFields = [
        'id_anmeldung',
        'id_person',
        'id_anlass',
        'anlassnummer',
        'matrikel_nr',
        'vornamen',
        'nachname',
        'eintritt_per',
        'eintritt_in_periode',
        'status_anmeldung',
    ];

    public function __construct()
    {

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

        var_dump($row);
    }
}
