<?php

namespace Database\Seeders;

use App\Services\Assessment\AssessmentCourseService;
use App\Services\Assessment\AssessmentService;
use App\Services\Course\CourseService;
use App\Services\StudyFieldYear\StudyFieldYearService;
use Illuminate\Database\Seeder;

class ChemieAssessment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(AssessmentService $assessmentService, CourseService $courseService, AssessmentCourseService $assessmentCourseService, StudyFieldYearService $studyFieldYearService)
    {
        $assessment = $assessmentService->create('Chemie - Standard');
        $studyFieldYear = $studyFieldYearService->getByEventoId(9322953);
        $studyFieldYearService->attacheAssessment($studyFieldYear, $assessment);

        $course = $courseService->getByEventoId(9301710);
        $assessmentCourseService->attache($assessment, $course);
    }
}
