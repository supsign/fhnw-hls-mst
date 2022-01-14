<?php

namespace App\Imports;

use App;
use App\Models\CourseRecommendation;
use App\Models\CrossQualification;
use App\Models\Specialization;
use App\Models\StudyField;
use App\Services\Course\CourseService;
use App\Services\Recommendation\RecommendationService;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RecommendationImport extends BaseExcelImport implements ToModel, WithHeadingRow
{
    protected CourseService $courseService;
    protected RecommendationService $recommendationService;
    protected array $requiredFields = [
        'studienrichtung',
        'spezialisierung',
        'querschnittsqualifikation',
        'modulnummer',
        'modulbezeichnung',
        'sem_in_dem_modul_v_sr_bestellt',
        'modulgruppe',
        'sem_in_dem_modul_v_sr_bestellt',
        'in Musterstudienplan',
        'assessmentmodul',
    ];

    public function __construct()
    {
        $this->courseService = App::make(CourseService::class);
        $this->recommendationService = App::make(RecommendationService::class);
    }

    /**
     * @param  array  $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($this->isEmptyRow($row)) {
            return;
        }

        if (is_null($row['in_musterstudienplan'])) {
            return;
        }

        foreach ($this->courseService->getByNumberUnformated($row['modulnummer']) AS $course) {
            $recommendationName = $row['studienrichtung'];

            if ($row['spezialisierung'] !== 'keine') {
                $recommendationName .= ' - '.$row['spezialisierung'];
                $specialisation = Specialization::where('name', $recommendationName)->first();
            } elseif ($row['querschnittsqualifikation'] !== 'keine') {
                $recommendationName .= ' - '.$row['querschnittsqualifikation'];
                $crossqualification = CrossQualification::where('name', $recommendationName)->first();
            }

            $recommendation = $this->recommendationService->getFirstOrCreateByName($recommendationName);

            if (!empty($specialisation)) {
                foreach ($specialisation->specializationYears AS $specializationYear) {
                    $specializationYear->update(['recommendation_id' => $recommendation->id]);
                }
            }

            if (!empty($crossqualification)) {
                foreach ($crossqualification->crossQualificationYears AS $crossQualificationYear) {
                    $crossQualificationYear->update(['recommendation_id' => $recommendation->id]);
                }
            }

            if (empty($specialisation) && empty($crossqualification)) {
                $studyField = StudyField::where('evento_number', 'like', '2-L-B-LS'.$recommendationName.'%')->first();

                if ($studyField) {
                    foreach ($studyField->studyFieldYears AS $studyFieldYear) {
                        $studyFieldYear->update(['recommendation_id' => $recommendation->id]);
                    }
                }
            }

            CourseRecommendation::firstOrCreate([
                'course_id' => $course->id,
                'recommendation_id' => $recommendation->id,
                'planned_semester' => $row['sem_in_dem_modul_v_sr_bestellt'],
            ]);
        }
    }
}
