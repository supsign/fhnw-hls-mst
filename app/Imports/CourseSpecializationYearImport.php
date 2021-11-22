<?php

namespace App\Imports;

use App;
use App\Services\Course\CourseService;
use App\Services\CourseSpecializationYear\CourseSpecializationYearSerivce;
use App\Services\Specialization\SpecializationService;

class CourseSpecializationYearImport extends BaseCsvImport
{
    protected CourseService $courseService;
    protected CourseSpecializationYearSerivce $courseSpecializationYearSerivce;
    protected SpecializationService $specializationService;
    protected $fileNames = ['modul_zu_spezialisierung.csv'];
    protected $fieldAddresses = ['id_spezialisierung', 'laufnummer', 'pflicht'];

    public function __construct()
    {
        $this->courseService = App::make(CourseService::class);
        $this->courseSpecializationYearSerivce = App::make(CourseSpecializationYearSerivce::class);
        $this->specializationService = App::make(SpecializationService::class);

        parent::__construct();
    }

    public function importLine()
    {
        if ($this->line['pflicht'] !== 't') {
            return $this;
        }

        $specialization = $this->specializationService->getByJanisId($this->line['id_spezialisierung']);

        if (!$specialization) {
            return $this;
        }

        $course = $this->courseService->getByNumber($this->line['laufnummer']);

        if (!$course) {
            return $this;
        }

        foreach ($specialization->specializationYears AS $specializationYears) {
            $this->courseSpecializationYearSerivce->updateOrCreate([
                'course_id' => $course->id,
                'specialization_year_id' => $specializationYears->id,
            ]);
        }

        return $this;
    }
}
