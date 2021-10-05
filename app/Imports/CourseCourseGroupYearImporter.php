<?php

namespace App\Imports;

use App;
use App\Services\Course\CourseService;
use App\Services\CourseGroup\CourseGroupService;
use App\Services\CourseCourseGroupYear\CourseCourseGroupYearService;

class CourseCourseGroupYearImporter extends BaseCsvImport
{
    protected CourseService $courseService;
    protected CourseGroupService $courseGroupService;
    protected CourseCourseGroupYearService $courseCourseGroupYearService;
    protected $fileNames = ['modul_zu_modulgruppe.csv'];
    protected $fieldAddresses = ['laufnummer', 'id_modulgruppe', 'semester'];

    public function __construct()
    {
        $this->courseService = App::make(CourseService::class);
        $this->courseGroupService = App::make(CourseGroupService::class);
        $this->courseCourseGroupYearService = App::make(CourseCourseGroupYearService::class);

        parent::__construct();
    }

    public function importLine()
    {
        $this->courseCourseGroupYearService->firstOrCreate([
            'course_id' => $this->courseService->getByNumber($this->line['laufnummer'])->id,
            'course_group_year_id' => $this->courseGroupService->getByImportId($this->line['id_modulgruppe'])->id,
        ]);
    }
}



