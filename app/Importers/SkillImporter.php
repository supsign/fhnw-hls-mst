<?php

namespace App\Importers;

use App\Models\Course;
use Supsign\LaravelCsvReader\CsvReader;

class SkillImporter extends CsvReader {
	protected 
		$fileNames = ['lernziel.csv'],
		$fieldAddresses = [],
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
		}

		return $this;
	}
}