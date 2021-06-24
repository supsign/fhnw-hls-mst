<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ModulSeeder extends Seeder
{
    private $module = [
        ['laufnummer' => 'B-LS-CH 026', 'modulbezeichnung' => 'Physikalische Chemie III', 'kuerzel' => 'PC3', 'semester' => 4, 'modulnummer' => 191, 'kreditpunkte' => 3, 'id_sprache' => 1, 'id_modultyp' => 1],
    ];

    public function run()
    {
        foreach ($this->module as $modul) {
            DB::table('hls.modul')->updateOrInsert([
                'laufnummer' => $modul['laufnummer'],
            ], [
                'modulbezeichnung' => $modul['modulbezeichnung'],
                'kuerzel' => $modul['kuerzel'],
                'semester' => $modul['semester'],
                'modulnummer' => $modul['modulnummer'],
                'kreditpunkte' => $modul['kreditpunkte'],
                'id_sprache' => $modul['id_sprache'],
                'id_modultyp' => $modul['id_modultyp'],
            ]);
        }
    }
}
