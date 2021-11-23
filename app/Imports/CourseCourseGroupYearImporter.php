<?php

namespace App\Imports;

use App;
use App\Models\CourseRecommendation;
use App\Models\Recommendation;
use App\Services\Course\CourseService;
use App\Services\CourseCourseGroupYear\CourseCourseGroupYearService;
use App\Services\CourseGroup\CourseGroupService;

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
        $course = $this->courseService->getByNumber($this->line['laufnummer']);
        $courseGroup = $this->courseGroupService->getByImportId($this->line['id_modulgruppe']);

        foreach ($courseGroup->courseGroupYears as $courseGroupYear) {
            $this->courseCourseGroupYearService->firstOrCreate([
                'course_id' => $course->id,
                'course_group_year_id' => $courseGroupYear->id,
            ]);

            if (empty($this->line['semester'])) {
                continue;
            }

            CourseRecommendation::firstOrCreate([
                'course_id' => $course->id,
                'planned_semester' => $this->line['semester'],
                'recommendation_id' => Recommendation::firstOrCreate([
                    'name' => $courseGroupYear->studyFieldYear->studyField->name,
                ])->id,
            ]);

        }

        return $this;
    }
}
