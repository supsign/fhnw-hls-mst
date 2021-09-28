<?php

namespace App\Imports;

use App\Services\StudyField\StudyFieldService;
use App\Services\StudyFieldYear\StudyFieldYearService;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudyFieldYearImport extends BaseImport implements ToModel, WithHeadingRow
{
    protected $requiredFields = ['id_anlass', 'anlassnummer', 'anlassbezeichnung', 'id_anlass_stdg', 'anlassnummer_stdg'];
    protected ?StudyFieldService $studyFieldService;
    protected ?StudyFieldYearService $studyFieldYearService;

    public function __construct()
    {
        $this->studyFieldService = App::make(StudyFieldService::class);
        $this->studyFieldYearService = App::make(StudyFieldYearService::class);
    }

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

        if (!$this->studyFieldService->getByEventoId($row['id_anlass_stdg'])) {
            //  Error, StudyField existiert nicht
            return;
        }

        $this->studyFieldYearService->createOrUpdateOnEventoId(
            $row['id_anlass'],
            [
                'evento_number' => $row['anlassnummer'],
                'study_field_id' => $row['id_anlass_stdg'],
            ],
        );
    }
}
