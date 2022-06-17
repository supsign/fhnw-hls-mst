<?php

namespace App\Imports;

use App;
use App\Models\CourseCrossQualificationYear;
use App\Services\Course\CourseService;
use App\Services\CrossQualification\CrossQualificationService;

class CourseCrossQualificationYearImport extends BaseCsvImport
{
    protected CourseService $courseService;
    protected CrossQualificationService $crossQualificationService;
    protected $fileNames = ['modul_zu_querschnittsqualifikation.csv'];
    protected $fieldAddresses = ['id_querschnittsqualifikation', 'laufnummer', 'bemerkung', 'pflicht'];

    public function __construct()
    {
        $this->courseService = App::make(CourseService::class);
        $this->crossQualificationService = App::make(CrossQualificationService::class);

        parent::__construct();
    }

    public function importLine()
    {
        $crossQualification = $this
            ->crossQualificationService
            ->getByJanisId($this->line['id_querschnittsqualifikation']);

        if (!$crossQualification) {
            return $this;
        }

        foreach ($this->courseService->getByNumberUnformated($this->line['laufnummer']) as $course) {
            // if ($crossQualification->study_field_id === 13 && $this->line['pflicht'] === 'f') {
            //     continue;
            // }

            foreach ($crossQualification->crossQualificationYears as $crossQualificationYear) {
                CourseCrossQualificationYear::updateOrCreate([
                    'course_id' => $course->id,
                    'cross_qualification_year_id' => $crossQualificationYear->id,
                ]);
            }
        }

        return $this;
    }
}
