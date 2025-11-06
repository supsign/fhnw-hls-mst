<?php

namespace App\Console\Commands;

use App\Models\StudyFieldYear;
use Exception;
use Illuminate\Console\Command;

class CopyToNewStudyFieldYears extends Command
{
    protected $signature = 'copy:studyfieldyears';
    protected $description = 'Copy Assessment, CrossQualification & Recommendation to new studyfieldyears';

    public function handle(): int
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
                'courseGroupYears.courseCourseGroupYears',
                'crossQualificationYears.courseCrossQualificationYears',
                'specializationYears.courseSpecializationYears',
            ])->find($sourceId);

            if (is_null($source)) {
                throw new Exception('studyFieldYear with ID "'.$sourceId.'" wasn\'t found');                
            }

            $targets = StudyFieldYear::whereIn('id', $targetIds)
                ->with([
                    'courseGroupYears.courseCourseGroupYears',
                    'crossQualificationYears.courseCrossQualificationYears',
                    'specializationYears.courseSpecializationYears',
                ])
                ->get();

            if ($targets->isEmpty()) {
                throw new Exception('no studyFieldYear with IDs "'.$targetIds.'" were found');
            }

            foreach ($source->courseGroupYears AS $sourceCourseGroupYear) {
                foreach ($targets AS $target) {
                    foreach ($target->courseGroupYears AS $targetCourseGroupYears) {
                        if ($sourceCourseGroupYear->cross_qualification_id === $targetCourseGroupYears->cross_qualification_id) {
                            continue 2;
                        }
                    }

                    $newCourseGroupYear = $sourceCourseGroupYear->replicate();

                    $newCourseGroupYear->study_field_year_id = $target->id;
                    $newCourseGroupYear->save();

                    foreach ($sourceCourseGroupYear->courseCourseGroupYears AS $sourceCourseCourseGroupYear) {
                        $newCourseCourseGroupYear = $sourceCourseCourseGroupYear->replicate();

                        $newCourseCourseGroupYear->course_group_year_id = $newCourseGroupYear->id;
                        $newCourseCourseGroupYear->save();
                    }
                }
            }

            foreach ($source->crossQualificationYears AS $sourceCrossQualificationYear) {
                foreach ($targets AS $target) {
                    foreach ($target->crossQualificationYears AS $targetCrossQualificationYear) {
                        if ($sourceCrossQualificationYear->cross_qualification_id === $targetCrossQualificationYear->cross_qualification_id) {
                            continue 2;
                        }
                    }

                    $newCrossQualificationYear = $sourceCrossQualificationYear->replicate();

                    $newCrossQualificationYear->study_field_year_id = $target->id;
                    $newCrossQualificationYear->save();

                    foreach ($sourceCrossQualificationYear->courseCrossQualificationYears AS $courseCrossQualificationYear) {
                        $newCourseCrossQualificationYear = $courseCrossQualificationYear->replicate();

                        $newCourseCrossQualificationYear->cross_qualification_year_id = $newCrossQualificationYear->id;
                        $newCourseCrossQualificationYear->save();
                    }
                }
            }

            foreach ($source->SpecializationYears AS $sourceSpecializationYear) {
                foreach ($targets AS $target) {
                    foreach ($target->SpecializationYears AS $targetSpecializationYear) {
                        if ($sourceSpecializationYear->specialization_id === $targetSpecializationYear->specialization_id) {
                            continue 2;
                        }
                    }

                    $newSpecializationYear = $sourceSpecializationYear->replicate();

                    $newSpecializationYear->study_field_year_id = $target->id;
                    $newSpecializationYear->save();

                    foreach ($sourceSpecializationYear->courseSpecializationYears AS $courseSpecializationYear) {
                        $newCourseSpecializationYear = $courseSpecializationYear->replicate();

                        $newCourseSpecializationYear->specialization_year_id = $newSpecializationYear->id;
                        $newCourseSpecializationYear->save();
                    }
                }
            }
        }

        return Command::SUCCESS;
    }
}
