<?php

namespace App\Imports;

use App;
use App\Services\Course\CourseService;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CourseReImport extends BaseExcelImport implements ToModel, WithHeadingRow
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

        $course = $this->service->getByEventoId($row['id_anlass']);

        if ($course) {
            return;
        }

        $this->service->createOrUpdateOnEventoId(
            $row['id_anlass'],
            [
                'course_type_id' => 1,
                'number' => $row['anlassnummer'],
                'name' => $row['anlassbezeichnung'],
                'language_id' => 1,
            ]
        );
    }
}
