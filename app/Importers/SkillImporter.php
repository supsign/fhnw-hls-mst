<?php

namespace App\Importers;

use App\Models\Course;
use App\Models\CourseSkill;
use App\Models\Skill;
use Supsign\LaravelCsvReader\CsvReader;

class SkillImporter extends CsvReader {
	protected 
		$fileNames = ['lernziel.csv'],
		$fieldAddresses = ['laufnummer', 'nummer', 'id_taxonomie', 'lernziel'],
		$lineDelimiter = ',';

	public function __construct() {
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
			'to_semester_id' => 1,
			'from_semester_id' => 1,
			'is_acquisition' => true,
		]);

		return $this;
	}
}