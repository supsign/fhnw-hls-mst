<?php

namespace App\Imports;

use App;
use App\Models\CourseSkill;
use App\Models\Semester;
use App\Models\Skill;
use App\Services\Course\CourseService;

class SkillImport extends BaseCsvImport
{
    protected CourseService $courseService;
    protected $fileNames = ['lernziel.csv'];
    protected $fieldAddresses = ['laufnummer', 'nummer', 'id_taxonomie', 'lernziel'];

    public function __construct()
    {
        $this->courseService = App::make(CourseService::class);

        parent::__construct();
    }

    public function importLine()
    {
        $skill = Skill::create([
            'taxonomy_id' => $this->line['id_taxonomie'],
            'definition' => $this->line['lernziel'],
        ]);

        CourseSkill::create([
            'skill_id' => $skill->id,
            'course_id' => $this->courseService->getByNumberUnformated($this->line['laufnummer'])->id,
            'from_semester_id' => Semester::whereNull('previous_semester_id')->first()->id,
            'goal_number' => $this->line['nummer'],
            'is_acquisition' => true,
        ]);

        return $this;
    }
}
