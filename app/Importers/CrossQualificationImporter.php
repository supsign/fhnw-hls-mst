<?php

namespace App\Importers;

use App\Models\CrossQualification;
use Supsign\LaravelCsvReader\CsvReader;

class CrossQualificationImporter extends CsvReader {
	protected 
		$fileNames = ['querschnittsqualifikation.csv'],
		$fieldAddresses = ['id_querschnittsqualifikation', 'bezeichnung', 'id_studienrichtung'],
		$lineDelimiter = ',';

	public function __construct() {
		$this->directories = [realpath(__DIR__).'/data/'];

		return $this;
	}

	public function importLine()
	{
		CrossQualification::create([
			'name' => $this->line['bezeichnung'],
			'study_field_id' => $this->line['id_studienrichtung'],
		]);

		return $this;
	}
}