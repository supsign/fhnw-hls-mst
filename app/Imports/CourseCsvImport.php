<?php

namespace App\Imports;

use App\Models\Course;

class CourseCsvImport extends BaseCsvImport
{
    protected $fileNames = ['modul.csv'];
    protected $fieldAddresses = ['bemerkungen', 'kreditpunkte', 'laufnummer', 'modulbezeichnung', 'modulbezeichnung_alternativ', 'kuerzel', 'semester', 'id_niveau', 'stichwoerter', 'id_sprache', 'letzte_aenderung', 'anzahl_durchfuehrungen', 'id_leistungsnachweis', 'lerninhalte', 'aktiv', 'stundenplanrelevant', 'summerschool', 'id_modus', 'id_herkunft', 'neu', 'winterschool', 'bibliographie', 'raumanforderung', 'id_methode', 'bonus', 'vorschlagsnote_anteil', 'zwischenpruefungen_anteil', 'msp', 'schlusspruefung_anteil', 'praktische_arbeit_anteil', 'id_modultyp', 'min_studis', 'max_studis', 'studis_geschaetzt', 'modulnummer'];

    public function importLine()
    {
        $data = [
            'number' => $this->line['laufnummer'],      //str_replace(' ', '', ),        //  '2-L-'.
            'name' => $this->line['modulbezeichnung'],
            'course_type_id' => $this->line['id_modultyp'],
        ];

        if ($this->line['id_sprache']) {
            $data['language_id'] = $this->line['id_sprache'];
        }

        if ($this->line['kreditpunkte']) {
            $data['credits'] = $this->line['kreditpunkte'];
        }

        Course::create($data);

        return $this;
    }
}
