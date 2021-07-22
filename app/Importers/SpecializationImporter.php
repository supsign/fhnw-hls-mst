<?php

namespace App\Importers;

use App\Models\Specialization;
use Supsign\LaravelCsvReader\CsvReader;

class SpecializationImporter extends CsvReader {
	protected 
		$fileNames = ['spezialisierung.csv'],
		$fieldAddresses = ['id_spezialisierung', 'bezeichnung', 'id_studienrichtung'],
		$lineDelimiter = ',';

	public function __construct() {
		$this->directories = [realpath(__DIR__).'/data/'];

		return $this;
	}

	public function importLine()
	{
		if (in_array($this->line['bezeichnung'], ['BZ', 'MI', 'MT', 'PT'])) {
			return $this;
		}

		Specialization::create([
			'name' => $this->line['bezeichnung'],
			'study_field_id' => $this->line['id_studienrichtung'],
		]);

		return $this;
	}
}