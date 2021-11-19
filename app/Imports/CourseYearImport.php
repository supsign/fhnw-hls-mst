<?php

namespace App\Imports;

use App;
use App\Services\Course\CourseService;
use App\Services\CourseYear\CourseYearService;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseYearImport extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected array $requiredFields = ['id_anlass', 'anlassnummer', 'anlassbezeichnung', 'id_anlass_modul', 'anlassnummer_modul'];
    protected CourseService $courseService;
    protected CourseYearService $courseYearSerivce;

    public function __construct()
    {
        $this->courseService = App::make(CourseService::class);
        $this->courseYearSerivce = App::make(CourseYearService::class);
    }

    /**
     * @param  array  $row
     * @return Model|null
     */
    public function model(array $row): void
    {
        if (!$this->hasRequiredFields($row) || $this->isEmptyRow($row)) {
            //  Throw error? Write log?
            return;
        }

        $course = $this->courseService->getByNumber($row['anlassnummer_modul']);

        if (!$course) {
            return;
        }

        $this->courseYearSerivce->createOrUpdateOnEventoId(
            $row['id_anlass'],
            $course,
            $row['anlassnummer'],
            $row['anlassbezeichnung']
        );
    }
}
