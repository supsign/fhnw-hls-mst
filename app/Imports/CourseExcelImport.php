<?php

namespace App\Imports;

use App;
use App\Services\Course\CourseService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseExcelImport extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected array $requiredFields = ['id_anlass', 'anlassnummer', 'anlassbezeichnung'];
    protected CourseService $service;

    public function __construct()
    {
        $this->service = App::make(CourseService::class);
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

        $this->service->firstOrCreateByNumber(
            $row['anlassnummer'],
            6,
            1,
            $row['anlassbezeichnung'],
        );
    }
}
