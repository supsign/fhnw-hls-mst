<?php

namespace App\Console\Commands;

use App\Models\Assessment;
use App\Models\CrossQualification;
use App\Models\Recommendation;
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
        $studyFieldMap = [
            37 => 15,
            38 => 14,
            39 => 13,
            40 => 11,
            41 => 12,
            42 => 8,
            43 => 15,
            44 => 9
        ];

        foreach (Assessment::with('assessmentCourses')->get() AS $assessment) {
            if (!in_array($assessment->study_field_id, $studyFieldMap)) {
                continue;
            }

            $copy = $assessment->replicate();
            $copy->study_field_id = array_search($assessment->study_field_id, $studyFieldMap);
            $copy->save();

            foreach ($assessment->assessmentCourses AS $assessmentCourses) {
                $pivotCopy = $assessmentCourses->replicate();
                $pivotCopy->assessment_id = $copy->id;
                $pivotCopy->save();
            }
        }

        foreach (Recommendation::with('courseRecommendations')->get() AS $recommendation) {
            if (!in_array($recommendation->study_field_id, $studyFieldMap)) {
                continue;
            }

            $copy = $recommendation->replicate();
            $copy->study_field_id = array_search($recommendation->study_field_id, $studyFieldMap);
            $copy->save();

            foreach ($recommendation->courseRecommendations AS $courseRecommendations) {
                $pivotCopy = $courseRecommendations->replicate();
                $pivotCopy->recommendation_id = $copy->id;
                $pivotCopy->save();
            }
        }

        foreach (CrossQualification::all() AS $crossQualification) {
            if (!in_array($crossQualification->study_field_id, $studyFieldMap)) {
                continue;
            }

            $copy = $crossQualification->replicate();
            $copy->study_field_id = array_search($crossQualification->study_field_id, $studyFieldMap);
            $copy->janis_id = null;
            $copy->save();













            
        }

        return Command::SUCCESS;
    }
}
