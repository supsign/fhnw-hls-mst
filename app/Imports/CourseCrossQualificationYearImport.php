<?php

namespace App\Imports;

use App;
use App\Models\CourseCrossQualificationYear;
use App\Models\StudyField;
use App\Services\Course\CourseService;
use App\Services\CrossQualification\CrossQualificationService;
use Illuminate\Database\Eloquent\Collection;

class CourseCrossQualificationYearImport extends BaseCsvImport
{
    protected Collection $chemistryCourses;
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

        $course = $this->courseService->getByNumberUnformated($this->line['laufnummer']);

        if (!$course) {
            return $this;
        }

        // if ($crossQualification->study_field_id === 13 && $this->line['pflicht'] === 'f') {
        //     return $this;
        // }

        foreach ($crossQualification->crossQualificationYears AS $crossQualificationYear) {
            CourseCrossQualificationYear::updateOrCreate([
                'course_id' => $course->id,
                'cross_qualification_year_id' => $crossQualificationYear->id,
            ]);
        }

        return $this;
    }
}
