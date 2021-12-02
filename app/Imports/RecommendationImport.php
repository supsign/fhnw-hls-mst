<?php

namespace App\Imports;

use App;
use App\Models\CourseRecommendation;
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

        $course = $this->courseService->getByNumberUnformated($row['modulnummer']);

        $recommendationName = $row['studienrichtung'];

        if ($row['spezialisierung'] !== 'keine') {
            $recommendationName .= ' '.$row['spezialisierung'];
        } elseif ($row['querschnittsqualifikation'] !== 'keine') {
            $recommendationName .= ' '.$row['querschnittsqualifikation'];
        }

        $recommendation = $this->recommendationService->getFirstOrCreateByName($recommendationName);

        CourseRecommendation::create([
            'course_id' => $course->id,
            'recommendation_id' => $recommendation->id,
            'planned_semester' => $row['sem_in_dem_modul_v_sr_bestellt'],
        ]);
    }
}
