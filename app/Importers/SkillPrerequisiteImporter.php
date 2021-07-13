<?php

namespace App\Importers;

use App\Models\Course;
use App\Models\CourseSkill;
use App\Models\Skill;
use Supsign\LaravelCsvReader\CsvReader;

class SkillPrerequisiteImporter extends CsvReader {
	protected 
		$fileNames = ['modulvoraussetzung.csv'],
		$fieldAddresses = ['id_modulvoraussetzung', 'laufnummer', 'voraussetzung_laufnummer', 'bemerkung', 'ziel1', 'ziel2', 'ziel3', 'ziel4', 'ziel5'],
		$lineDelimiter = ',';

	public function __construct() {
		$this->directories = [realpath(__DIR__).'/data/'];

		return $this;
	}

	public function importLine()
	{
		$prerequisiteCourse = Course::where('number', $this->line['voraussetzung_laufnummer'])->first();

		if (!$prerequisiteCourse) {
			return $this;
		}

		foreach ($prerequisiteCourse->courseSkills->sortBy('goal_number') AS $courseSkill) {
			CourseSkill::create([
				'skill_id' => $courseSkill->skill_id,
				'course_id' => Course::where('number', $this->line['laufnummer'])->first()->id,
				'semester_id' => 1,
				'is_acquisition' => false,
			]);
		}

		return $this;
	}
}