<?php

namespace App\Importers;

use App\Models\Course;
use App\Models\Event;
use Supsign\LaravelCsvReader\CsvReader;

class CourseImporter extends CsvReader
{
    protected $fileNames = ['modul.csv'];
    protected $fieldAddresses = ['bemerkungen', 'kreditpunkte', 'laufnummer', 'modulbezeichnung', 'modulbezeichnung_alternativ', 'kuerzel', 'semester', 'id_niveau', 'stichwoerter', 'id_sprache', 'letzte_aenderung', 'anzahl_durchfuehrungen', 'id_leistungsnachweis', 'lerninhalte', 'aktiv', 'stundenplanrelevant', 'summerschool', 'id_modus', 'id_herkunft', 'neu', 'winterschool', 'bibliographie', 'raumanforderung', 'id_methode', 'bonus', 'vorschlagsnote_anteil', 'zwischenpruefungen_anteil', 'msp', 'schlusspruefung_anteil', 'praktische_arbeit_anteil', 'id_modultyp', 'min_studis', 'max_studis', 'studis_geschaetzt', 'modulnummer'];
    protected $lineDelimiter = ',';

    public function __construct()
    {
        $this->directories = [realpath(__DIR__).'/data/'];

        return $this;
    }

    public function importLine()
    {
        $data = [
            'number' => $this->line['laufnummer'],
            'course_type_id' => $this->line['id_modultyp'],
        ];

        if ($this->line['id_sprache']) {
            $data['language_id'] = $this->line['id_sprache'];
        }

        if ($this->line['kreditpunkte']) {
            $data['credits'] = $this->line['kreditpunkte'];
        }

        Course::create($data);

        // Event::create([
        // 	'name' => $this->line['modulbezeichnung'],
        // 	'course_id' => Course::create($data)->id,
        // 	'semester_id' => 1,
        // ]);

        return $this;
    }
}
