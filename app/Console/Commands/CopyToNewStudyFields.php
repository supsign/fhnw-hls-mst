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
             8 => 42,
             9 => 44,
            11 => 40,
            12 => 41,
            13 => 39,
            14 => 38,
            // 15 => 
        ];

        foreach (Assessment::all() AS $assassment) {
            if (!array_key_exists($assassment->study_field_id, $studyFieldMap)) {
                continue;
            }

            $copy = $assassment->replicate();
            $copy->study_field_id = $studyFieldMap[$assassment->study_field_id];
            $copy->save();
        }

        foreach (CrossQualification::all() AS $crossQualification) {
            if (!array_key_exists($crossQualification->study_field_id, $studyFieldMap)) {
                continue;
            }

            $copy = $crossQualification->replicate();
            $copy->study_field_id = $studyFieldMap[$crossQualification->study_field_id];
            $copy->janis_id = null;
            $copy->save();
        }

        foreach (Recommendation::all() AS $recommendation) {
            if (!array_key_exists($recommendation->study_field_id, $studyFieldMap)) {
                continue;
            }

            $copy = $recommendation->replicate();
            $copy->study_field_id = $studyFieldMap[$recommendation->study_field_id];
            $copy->save();
        }

        return Command::SUCCESS;
    }
}
