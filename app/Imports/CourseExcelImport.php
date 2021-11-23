<?php

namespace App\Imports;

use App;
use App\Services\Course\CourseService;
use Illuminate\Database\Eloquent\Model;
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
     * @return Model|null
     */
    public function model(array $row): void
    {
        if (!$this->hasRequiredFields($row) || $this->isEmptyRow($row)) {
            //  Throw error? Write log?
            return;
        }

        $course = $this->service->getByNumber(
            $this->formatEventoNumber($row['anlassnummer'])
        );

        if ($course) {
            $this->service->updateOrCreate([
                'id' => $course->id,
            ], [
                'evento_id' => $row['id_anlass'],
                'number' => $row['anlassnummer'],
                'name' => $row['anlassbezeichnung'],
            ]);

            return;
        }

        $this->service->createOrUpdateOnEventoId(
            $row['id_anlass'],
            [
                'course_type_id' => 6,
                'number' => $row['anlassnummer'],
                'name' => $row['anlassbezeichnung'],
            ]
        );
    }
}
