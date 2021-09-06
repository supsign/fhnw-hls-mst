<?php

namespace App\Importers;

use App\Models\Course;
use App\Models\CourseSkill;
use App\Models\Skill;
use Supsign\LaravelCsvReader\CsvReader;

class SkillImporter extends CsvReader
{
    protected $fileNames = ['lernziel.csv'];
    protected $fieldAddresses = ['laufnummer', 'nummer', 'id_taxonomie', 'lernziel'];
    protected $lineDelimiter = ',';

    public function __construct()
    {
        $this->directories = [realpath(__DIR__).'/data/'];

        return $this;
    }

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
