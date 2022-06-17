<?php

namespace App\Imports;

use App;
use App\Services\CourseGroup\CourseGroupService;
use App\Services\CourseGroupYear\CourseGroupYearService;
use App\Services\StudyField\StudyFieldService;

class CourseGroupYearCsvImport extends BaseCsvImport
{
    protected CourseGroupService $courseGroupService;
    protected CourseGroupYearService $courseGroupYearService;
    protected $fileNames = ['modulgruppe_zu_studienrichtung.csv'];
    protected $fieldAddresses = ['id_studienrichtung', 'id_modulgruppe', 'mindestpunktzahl'];
    protected StudyFieldService $studyFieldService;

    public function __construct()
    {
        $this->courseGroupService = App::make(CourseGroupService::class);
        $this->courseGroupYearService = App::make(CourseGroupYearService::class);
        $this->studyFieldService = App::make(StudyFieldService::class);

        parent::__construct();
    }

    public function importLine()
    {
        $couseGroup = $this->courseGroupService->getByImportId($this->line['id_modulgruppe']);
        $studyField = $this->studyFieldService->getById($this->line['id_studienrichtung']);

        if (!$couseGroup || !$studyField) {
            return $this;
        }

        foreach ($studyField->studyFieldYears as $studyFieldYear) {
            $this->courseGroupYearService->updateOrCreate([
                'course_group_id' => $couseGroup->id,
                'study_field_year_id' => $studyFieldYear->id,
            ], [
                'credits_to_pass' => $this->line['mindestpunktzahl'],
            ]);
        }

        return $this;
    }
}
