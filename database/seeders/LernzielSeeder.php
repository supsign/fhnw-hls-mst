<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class LernzielSeeder extends Seeder
{
    private $lernziele = [
        ['laufnummer' => 'B-LS-CH 026', 'id_taxonomie' => 3, 'nummer' => 1, 'lernziel' => 'sind fähig den zweiten Hauptsatz der Thermodynamik auf Mischphasen anzuwenden'],
        ['laufnummer' => 'B-LS-CH 026', 'id_taxonomie' => 2, 'nummer' => 2, 'lernziel' => 'verstehen das Konzept der partiellen molaren Grössen'],
        ['laufnummer' => 'B-LS-CH 026', 'id_taxonomie' => 3, 'nummer' => 3, 'lernziel' => 'können das Konzept des chemischen Potentials auf das Gleichgewicht von Mischphasen und das chemische Gleichgewicht anwenden.'],
        ['laufnummer' => 'B-LS-CH 026', 'id_taxonomie' => 3, 'nummer' => 4, 'lernziel' => 'können für einfache Beispiele die Lage des chemischen Gleichgewichts berechnen'],
        ['laufnummer' => 'B-LS-CH 026', 'id_taxonomie' => 2, 'nummer' => 5, 'lernziel' => 'können einfache Phasendiagramme gas/flüssig interpretieren'],
    ];

    public function run()
    {
        foreach ($this->lernziele as $lernziel) {
            DB::table('hls.lernziel')->updateOrInsert([
                'laufnummer' => $lernziel['laufnummer'],
                'nummer' => $lernziel['nummer'],
            ], [
                'lernziel' => $lernziel['lernziel'],
                'id_taxonomie' => $lernziel['id_taxonomie'],
            ]);
        }
    }
}
