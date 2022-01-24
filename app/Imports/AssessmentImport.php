<?php

namespace App\Imports;

use App;
use App\Services\Assessment\AssessmentCourseService;
use App\Services\Assessment\AssessmentService;
use App\Services\Course\CourseService;
use App\Services\StudyField\StudyFieldService;

class AssessmentImport extends BaseCsvImport
{
    protected AssessmentService $assessmentService;
    protected AssessmentCourseService $assessmentCourseService;
    protected CourseService $courseService;
    protected StudyFieldService $studyFieldService;
    protected $fileNames = ['modul_zu_studienrichtung_assessment.csv'];
    protected $fieldAddresses = ['laufnummer', 'id_studienrichtung', 'bemerkungen'];

    public function __construct()
    {
        $this->assessmentService = App::make(AssessmentService::class);
        $this->assessmentCourseService = App::make(AssessmentCourseService::class);
        $this->courseService = App::make(CourseService::class);
        $this->studyFieldService = App::make(StudyFieldService::class);

        parent::__construct();
    }

    public function importLine()
    {
        foreach ($this->courseService->getByNumberUnformated($this->line['laufnummer']) as $course) {
            $studyField = $this->studyFieldService->getById($this->line['id_studienrichtung']);

            if (!$studyField) {
                return $this;
            }

            foreach ($studyField->studyFieldYears as $studyFieldYear) {
                $assessment = $this->assessmentService->firstOrCreateByName($studyFieldYear->studyField->name, $studyField);
                $this->assessmentCourseService->attach($assessment, $course);

                $studyFieldYear->update(['assessment_id' => $assessment->id]);
            }
        }

        return $this;
    }
}
