<?php

namespace App\Imports;

use App\Models\Course;
use App\Models\CourseSkill;
use App\Models\Semester;

class SkillPrerequisiteImport extends BaseCsvImport
{
    protected $fileNames = ['modulvoraussetzung.csv'];
    protected $fieldAddresses = ['id_modulvoraussetzung', 'laufnummer', 'voraussetzung_laufnummer', 'bemerkung', 'ziel1', 'ziel2', 'ziel3', 'ziel4', 'ziel5'];

    public function importLine()
    {
        $prerequisiteCourse = Course::where('number', $this->line['voraussetzung_laufnummer'])->first();

        if (!$prerequisiteCourse) {
            return $this;
        }

        foreach ($prerequisiteCourse->courseSkills()->where(['is_acquisition' => true])->get()->sortBy('goal_number') as $courseSkill) {
            if ($this->line['ziel'.$courseSkill->goal_number] === 't') {
                CourseSkill::create([
                    'skill_id' => $courseSkill->skill_id,
                    'course_id' => Course::where('number_unformated', $this->line['laufnummer'])->first()->id,
                    'from_semester_id' => Semester::whereNull('previous_semester_id')->first()->id,
                    'is_acquisition' => false,
                ]);
            }
        }

        return $this;
    }
}
