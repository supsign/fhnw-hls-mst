<?php

namespace App\Imports;

use App\Services\StudyField\StudyFieldService;
use App\Services\StudyFieldYear\CreateStudyFieldYearByImportService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudyFieldYearReImport extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected array $requiredFields = ['id_anlass', 'anlassnummer', 'anlassbezeichnung', 'id_anlass_stdg', 'anlassnummer_stdg'];
    protected ?StudyFieldService $studyFieldService;
    protected ?CreateStudyFieldYearByImportService $createStudyFieldYearByImportService;

    public function __construct()
    {
        $this->studyFieldService = App::make(StudyFieldService::class);
        $this->createStudyFieldYearByImportService = App::make(CreateStudyFieldYearByImportService::class);
    }

    /**
     * @param  array  $row
     * @return Model|null
     */
    public function model(array $row)
    {
        if (!$this->hasRequiredFields($row) || $this->isEmptyRow($row)) {
            //  Throw error? Write log?
            return null;
        }

        $studyField = $this->studyFieldService->getByEventoId($row['id_anlass_stdg']);

        if (!$studyField) {
            //  Error, StudyField existiert nicht
            return null;
        }

        if ($row['id_anlass'] == 9749132) {
            return null;
        }

        return $this->createStudyFieldYearByImportService->createNewByReImport($row['id_anlass'], $studyField, $row['anlassnummer']);
    }
}
