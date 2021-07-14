<?php

namespace App\Importers;

use App\Models\Course;
use App\Models\CourseSpecialization;
use App\Models\Specialization;
use Supsign\LaravelCsvReader\CsvReader;

class CourseSpecializationImporter extends CsvReader {
	protected 
		$fileNames = ['modul_zu_spezialisierung.csv'],
		$fieldAddresses = ['id_spezialisierung', 'laufnummer', 'pflicht'],
		$lineDelimiter = ',';

	public function __construct() {
		$this->directories = [realpath(__DIR__).'/data/'];

		return $this;
	}

	public function importLine()
	{
		if (!Specialization::find($this->line['id_spezialisierung'])) {
			return $this;
		}

		CourseSpecialization::create([
			'course_id' => Course::where('number', $this->line['laufnummer'])->first()->id,
			'specialization_id' => $this->line['id_spezialisierung'],
		]);

		return $this;
	}
}