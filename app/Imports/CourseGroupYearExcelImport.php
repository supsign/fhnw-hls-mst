<?php

namespace App\Imports;

use App;
use App\Services\Course\CourseService;
use App\Services\CourseGroupYear\CourseGroupYearService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseGroupYearExcelImport extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected array $requiredFields = ['id_anlass', 'anlassnummer', 'anlassbezeichnung', 'id_anlass_modul', 'anlassnummer_modul'];
    protected CourseService $courseService;
    protected CourseGroupYearService $courseGroupYearService;

    public function __construct()
    {
        $this->courseService = App::make(CourseService::class);
        $this->courseGroupYearService = App::make(CourseGroupYearService::class);
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

        var_dump(
            $row,
            $this->courseService->getByNumber($row['anlassnummer_modul'])->id,
        );
    }
}
