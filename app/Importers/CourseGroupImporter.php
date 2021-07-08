<?php

namespace App\Importers;

use App\Models\CourseGroup;
use Supsign\LaravelCsvReader\CsvReader;

class CourseGroupImporter extends CsvReader {
	protected
		$fileNames = ['modulgruppe.csv'],
		$fieldAddresses = ['modulgruppenbezeichnung', 'id_modulgruppe', 'beschreibung', 'kuerzel', 'neu'],
		$lineDelimiter = ',';

	public function __construct() {
		$this->directories = [realpath(__DIR__).'/data/'];

		return $this;
	}

	public function import() {
		$this->readFiles();

		while ($this->iterateLines() ) {
			if (array_keys($this->line) == array_values($this->line)) {
				continue;
			}

			CourseGroup::firstOrCreate([
				'import_id' => $this->line['id_modulgruppe'],
				'name' => $this->line['modulgruppenbezeichnung']
			]);
		}

		return $this;
	}
}