<?php

namespace App\Importers;

use App\Models\Course;
use Supsign\LaravelCsvReader\CsvReader;

class CourseImporter extends CsvReader {
	protected 
		$fileNames = ['modul.csv'],
		$fieldAddresses = ['bemerkungen', 'kreditpunkte', 'laufnummer', 'modulbezeichnung', 'modulbezeichnung_alternativ', 'kuerzel', 'semester', 'id_niveau', 'stichwoerter', 'id_sprache', 'letzte_aenderung', 'anzahl_durchfuehrungen', 'id_leistungsnachweis', 'lerninhalte', 'aktiv', 'stundenplanrelevant', 'summerschool', 'id_modus', 'id_herkunft', 'neu', 'winterschool', 'bibliographie', 'raumanforderung', 'id_methode', 'bonus', 'vorschlagsnote_anteil', 'zwischenpruefungen_anteil', 'msp', 'schlusspruefung_anteil', 'praktische_arbeit_anteil', 'id_modultyp', 'min_studis', 'max_studis', 'studis_geschaetzt', 'modulnummer'],
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

			$data = [
				'number' => $this->line['laufnummer'],
				'name' => $this->line['modulbezeichnung'],
				'course_type_id' => $this->line['id_modultyp'],
			];	

			if ($this->line['id_sprache']) {
				$data['langauge_id'] = $this->line['id_sprache'];
			}

			if ($this->line['kreditpunkte']) {
				$data['credits'] = $this->line['kreditpunkte'];
			}

			Course::create($data);
		}

		return $this;
	}
}