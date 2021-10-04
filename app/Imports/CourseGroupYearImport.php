<?php

namespace App\Imports;

use App;
use App\Services\CourseGroup\CourseGroupService;
use App\Services\CourseGroupYear\CourseGroupYearService;
use App\Services\StudyFieldYear\StudyFieldYearService;

class CourseGroupYearImport extends BaseCsvImport
{
    protected CourseGroupService $courseGroupService;
    protected CourseGroupYearService $courseGroupYearService;
    protected $fileNames = ['modulgruppe_zu_studienrichtung.csv'];
    protected $fieldAddresses = ['id_studienrichtung', 'id_modulgruppe', 'mindestpunktzahl'];
    protected StudyFieldYearService $studyFieldYearService;

    public function __construct()
    {
        $this->courseGroupService = App::make(CourseGroupService::class);
        $this->courseGroupYearService = App::make(CourseGroupYearService::class);
        $this->studyFieldYearService = App::make(StudyFieldYearService::class);

        parent::__construct();
    }

    public function importLine()
    {
        $couseGroup = $this->courseGroupService->getByImportId($this->line['id_modulgruppe']);

        if (!$couseGroup) {
            //  Todo? Logging or Error
            return;
        }

        $this->courseGroupYearService->updateOrCreate([
            'course_group_id' => $couseGroup->id,
            'study_field_year_id' => null,                  //  $this->line['id_studienrichtung'] bezieht sich worauf?
        ], [
            'amount_to_pass' => $this->line['mindestpunktzahl'],
        ]);
    }
}



