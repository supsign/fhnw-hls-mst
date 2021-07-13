<?php

namespace App\Importers;

use App\Models\Course;
use App\Models\CourseGroup;
use App\Models\CourseCourseGroup;
use Supsign\LaravelCsvReader\CsvReader;

class CourseCourseGroupImporter extends CsvReader {
	protected 
		$fileNames = ['modul_zu_modulgruppe.csv'],
		$fieldAddresses = ['laufnummer', 'id_modulgruppe', 'semester'],
		$lineDelimiter = ',';

	public function __construct() {
		$this->directories = [realpath(__DIR__).'/data/'];

		return $this;
	}

	public function importLine()
	{
		$course = Course::where('number', $this->line['laufnummer'])->first();
		$courseGroup = CourseGroup::where('import_id', $this->line['id_modulgruppe'])->first();

		CourseCourseGroup::create([
			'course_id' => $course->id,
			'course_group_id' => $courseGroup->id,
			'begin_semester_id' => 1,
		]);
	}
}