<?php

namespace App\Console\Commands;

use App\Models\Assessment;
use App\Models\Recommendation;
use App\Models\StudyField;
use Illuminate\Console\Command;

class CopyToNewStudyFields extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:studyfields';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy Assessment, CrossQualification & Recommendation to new studyfields';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //  target => source
        $studyFieldMap = [
            44 => 45,
        ];

        foreach (Assessment::with('assessmentCourses')->get() as $assessment) {
            if (!in_array($assessment->study_field_id, $studyFieldMap)) {
                continue;
            }

            $copy = $assessment->replicate();
            $copy->study_field_id = array_search($assessment->study_field_id, $studyFieldMap);
            $copy->save();

            foreach ($assessment->assessmentCourses as $assessmentCourses) {
                $pivotCopy = $assessmentCourses->replicate();
                $pivotCopy->assessment_id = $copy->id;
                $pivotCopy->save();
            }
        }

        foreach (Recommendation::with('courseRecommendations')->get() as $recommendation) {
            if (!in_array($recommendation->study_field_id, $studyFieldMap)) {
                continue;
            }

            $copy = $recommendation->replicate();
            $copy->study_field_id = array_search($recommendation->study_field_id, $studyFieldMap);
            $copy->save();

            foreach ($recommendation->courseRecommendations as $courseRecommendations) {
                $pivotCopy = $courseRecommendations->replicate();
                $pivotCopy->recommendation_id = $copy->id;
                $pivotCopy->save();
            }
        }

        $studyFields = StudyField::whereIn('id', $studyFieldMap)
            ->with('crossQualifications.crossQualificationYears')
            ->get();

        foreach ($studyFields as $studyField) {
            foreach ($studyField->crossQualifications as $crossQualification) {
                $newCrossQualitifacton = $crossQualification->replicate();
                $newCrossQualitifacton->janis_id = null;
                $newCrossQualitifacton->study_field_id = array_search($studyField->id, $studyFieldMap);
                $newCrossQualitifacton->save();
            }
        }

        return Command::SUCCESS;
    }
}
