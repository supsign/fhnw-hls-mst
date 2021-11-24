<?php

namespace Database\Seeders;

use App\Models\CourseRecommendation;
use App\Services\Course\CourseService;
use App\Services\Recommendation\RecommendationService;
use Illuminate\Database\Seeder;

class ChemieRecommendations extends Seeder
{
    private $data = [
        ['number' => 'B-LS-KT 039', 'semester' => 1],
        ['number' => 'B-LS-CH 017', 'semester' => 3],
        ['number' => 'B-LS-KT 008', 'semester' => 4],
        ['number' => 'B-LS-KT 029a', 'semester' => 2],
        ['number' => 'B-LS-KT 002a', 'semester' => 3],
        ['number' => 'B-LS-KT 014', 'semester' => 1],
        ['number' => 'B-LS-BZ 007', 'semester' => 4],
        ['number' => 'B-LS-BZ 004', 'semester' => 5],
        ['number' => 'B-LS-CH 020', 'semester' => 5],
        ['number' => 'B-LS-CH 012', 'semester' => 2],
        ['number' => 'B-LS-MI 002a', 'semester' => 2],
        ['number' => 'B-LS-MI 001', 'semester' => 3],
        ['number' => 'B-LS-KT 004', 'semester' => 2],
        ['number' => 'B-LS-KT 025', 'semester' => 4],
        ['number' => 'B-LS-BZ 001', 'semester' => 1],
        ['number' => 'B-LS-BZ 017', 'semester' => 2],
        ['number' => 'B-LS-CH 003', 'semester' => 1],
        ['number' => 'B-LS-PT 004', 'semester' => 2],
        ['number' => 'B-LS-KT 007', 'semester' => 1],
        ['number' => 'B-LS-CH 007', 'semester' => 1],
        ['number' => 'B-LS-KT 033', 'semester' => 4],
        ['number' => 'B-LS-CH 013', 'semester' => 1],
        ['number' => 'B-LS-CH 022', 'semester' => 3],
        ['number' => 'B-LS-CH 039', 'semester' => 5],
        ['number' => 'B-LS-CH 008', 'semester' => 2],
        ['number' => 'B-LS-CH 009', 'semester' => 3],
        ['number' => 'B-LS-CH 024', 'semester' => 4],
        ['number' => 'B-LS-CH 025', 'semester' => 5],
        ['number' => 'B-LS-CH 010', 'semester' => 2],
        ['number' => 'B-LS-CH 011', 'semester' => 3],
        ['number' => 'B-LS-CH 026', 'semester' => 4],
        ['number' => 'B-LS-CH 041', 'semester' => 4],
        ['number' => 'B-LS-CH 014', 'semester' => 1],
        ['number' => 'B-LS-CH 027', 'semester' => 3],
        ['number' => 'B-LS-CH 028', 'semester' => 4],
        ['number' => 'B-LS-CH 029', 'semester' => 5],
        ['number' => 'B-LS-CH 030', 'semester' => 5],
        ['number' => 'B-LS-BZ 044', 'semester' => 2],
        ['number' => 'B-LS-BZ 016', 'semester' => 5],
        ['number' => 'B-LS-CH 015', 'semester' => 1],
        ['number' => 'B-LS-CH 032', 'semester' => 3],
        ['number' => 'B-LS-CH 033', 'semester' => 4],
        ['number' => 'B-LS-CH 034', 'semester' => 5],
        ['number' => 'B-LS-CH 035', 'semester' => 5],
        ['number' => 'B-LS-PT 013', 'semester' => 2],
        ['number' => 'B-LS-CH 036', 'semester' => 3],
        ['number' => 'B-LS-KT 016a', 'semester' => 2],
        ['number' => 'B-LS-KT 028', 'semester' => 1],
        ['number' => 'B-LS-CH 038', 'semester' => 5],
        ['number' => 'B-LS-KT 036a', 'semester' => 1],
        ['number' => 'B-LS-CH 044', 'semester' => 6],
        ['number' => 'B-LS-CH 043', 'semester' => 6],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(CourseService $courseService, RecommendationService $recommendationService)
    {
        $recommendation = $recommendationService->getFirstByName('Chemie');

        if (!$recommendation) {
            return;
        }

        foreach ($recommendation->courseRecommendations as $courseRecommendation) {
            $courseRecommendation->delete();
        }
        foreach ($this->data as $rec) {
            $course = $courseService->getByNumberUnformated($rec['number']);
            if (!$course) {
                continue;
            }

            CourseRecommendation::create(['course_id' => $course->id, 'recommendation_id' => $recommendation->id, 'planned_semester' => $rec['semester']]);
        }
    }
}
