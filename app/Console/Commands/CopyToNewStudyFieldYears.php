<?php

namespace App\Console\Commands;

use App\Models\StudyFieldYear;
use Exception;
use Illuminate\Console\Command;

class CopyToNewStudyFieldYears extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:studyfieldyears';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy Assessment, CrossQualification & Recommendation to new studyfieldyears';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //  source => targets
        $studyFieldYearMap = [
            43 => 51,    //  Biotechnologie ab 2024
            44 => 52,    //  Bioanalytik und Zellbiologie ab 2024
            45 => 53,    //  Chemical Engineering ab 2024
            46 => 54,    //  Chemie ab 2024
            47 => 55,    //  Medizininformatik ab 2024
            48 => 56,    //  Medizintechnik ab 2024
            49 => 57,    //  Pharmatechnologie ab 2024

        ];

        foreach ($studyFieldYearMap AS $sourceId => $targetIds) {
            if (!is_array($targetIds)) {
                $targetIds = [$targetIds];
            }

            $source = StudyFieldYear::with([
                'crossQualificationYears',
                'specializationYears',
            ])->find($sourceId);

            $targets = StudyFieldYear::with([
                'crossQualificationYears',
                'specializationYears',
            ])->whereIn('id', $targetIds)->get();

            if (is_null($source)) {
                throw new Exception('studyFieldYear with ID "'.$sourceId.'" wasn\'t found');                
            }

            if ($targets->isEmpty()) {
                throw new Exception('no studyFieldYear with IDs "'.$targetIds.'" were found');
            }

            foreach ($source->crossQualificationYears AS $sourceCrossQualificationYear) {
                foreach ($targets AS $target) {
                    foreach ($target->crossQualificationYears AS $targetCrossQualificationYear) {
                        if ($sourceCrossQualificationYear->cross_qualification_id === $targetCrossQualificationYear->cross_qualification_id) {
                            continue 2;
                        }
                    }

                    $new = $sourceCrossQualificationYear->replicate();

                    $new->study_field_year_id = $target->id;
                    $new->save();
                }

            }

            foreach ($source->SpecializationYears AS $sourceSpecializationYear) {
                foreach ($targets AS $target) {
                    foreach ($target->SpecializationYears AS $targetSpecializationYear) {
                        if ($sourceSpecializationYear->specialization_id === $targetSpecializationYear->specialization_id) {
                            continue 2;
                        }
                    }

                    $new = $sourceSpecializationYear->replicate();

                    $new->study_field_year_id = $target->id;
                    $new->save();
                }
            }
        }

        return Command::SUCCESS;
    }
}
