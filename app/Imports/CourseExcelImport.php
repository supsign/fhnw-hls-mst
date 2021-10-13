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

        $course = $this->service->getByNumber(
            $this->formatEventoNumber($row['anlassnummer'])
        );

        if ($course) {
            $this->service->updateOrCreate([
                'id' => $course->id,
            ], [
                'number' => $row['anlassnummer'],
                'name' => $row['anlassbezeichnung'],    //  name updaten?
            ]);

            return;
        }

        echo 'new none-matching '.$row['anlassnummer'].PHP_EOL;

        $course = $this->service->updateOrCreate([
            'number' => $row['anlassnummer'],
        ], [
            'course_type_id' => 6,
            'name' => $row['anlassbezeichnung'],    //  name updaten?
        ]);

        if ($course->wasRecentlyCreated) {
            echo 'newly created '.$row['anlassnummer'].PHP_EOL;
        }
    }
}
