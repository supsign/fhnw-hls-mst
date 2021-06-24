<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class StudienrichtungSeeder extends Seeder
{
    private $studienrichtungen = [
        ['id_studienrichtung' => '13', 'id_studiengang' => 6, 'bezeichnung' => 'Chemie', 'kuerzel' => 'CH', 'personalnummer' => 25, 'neu' => false],
        ['id_studienrichtung' => '12', 'id_studiengang' => 6, 'bezeichnung' => 'Medizintechnik', 'kuerzel' => 'MT', 'personalnummer' => 12, 'neu' => false],
    ];

    public function run()
    {
        foreach ($this->studienrichtungen as $studienrichtung) {
            DB::table('hls.studienrichtung')->updateOrInsert([
                'id_studienrichtung' => $studienrichtung['id_studienrichtung'],
            ], [
                'bezeichnung' => $studienrichtung['bezeichnung'],
                'kuerzel' => $studienrichtung['kuerzel'],
                'personalnummer' => $studienrichtung['personalnummer'],
                'neu' => (bool) $studienrichtung['neu'],
                'id_studiengang' => $studienrichtung['id_studiengang'],
            ]);
            DB::statement('ALTER SEQUENCE hls.studienrichtung_id_studienrichtung_seq RESTART with 41;');
        }
    }
}
