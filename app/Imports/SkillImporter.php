<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\CourseSkill;
use App\Models\Skill;

class SkillImporter extends BaseCsvImport
{
    protected $fileNames = ['lernziel.csv'];
    protected $fieldAddresses = ['laufnummer', 'nummer', 'id_taxonomie', 'lernziel'];

    public function importLine()
    {
        $skill = Skill::create([
            'taxonomy_id' => $this->line['id_taxonomie'],
            'definition' => $this->line['lernziel'],
        ]);

        CourseSkill::create([
            'skill_id' => $skill->id,
            'course_id' => Course::where('number', $this->line['laufnummer'])->first()->id,
            'semester_id' => 1,
            'goal_number' => $this->line['nummer'],
            'is_acquisition' => true,
        ]);

        return $this;
    }
}