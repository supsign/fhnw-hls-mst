<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class StudiengangSeeder extends Seeder
{
    private $studiengaenge = [
        ['id_studiengang' => '3', 'id_stufe' => 2, 'bezeichnung' => 'MAS Umwelttechnik und -management', 'kuerzel' => 'MAS-U', 'personalnummer' => 359, 'neu' => false],
        ['id_studiengang' => '4', 'id_stufe' => 3, 'bezeichnung' => 'Master of Science in Life Sciences', 'kuerzel' => 'MScLS', 'personalnummer' => 93, 'neu' => false],
        ['id_studiengang' => '5', 'id_stufe' => 4, 'bezeichnung' => 'Administration: Allgemein', 'kuerzel' => 'Sonst', 'personalnummer' => null, 'neu' => false],
        ['id_studiengang' => '6', 'id_stufe' => 1, 'bezeichnung' => 'Bachelor of Science in Life Sciences', 'kuerzel' => 'BScLS', 'personalnummer' => null, 'neu' => true],
        ['id_studiengang' => '7', 'id_stufe' => 3, 'bezeichnung' => 'Master of Science in Medical Informatics', 'kuerzel' => 'MScMI', 'personalnummer' => 310, 'neu' => true],
        ['id_studiengang' => '8', 'id_stufe' => 2, 'bezeichnung' => 'Weitere Certificates of Advanced Studies', 'kuerzel' => 'CAS', 'personalnummer' => null, 'neu' => true],
    ];

    public function run()
    {
        foreach ($this->studiengaenge as $studiengang) {
            DB::table('hls.studiengang')->updateOrInsert([
                'id_studiengang' => $studiengang['id_studiengang'],
            ], [
                'bezeichnung' => $studiengang['bezeichnung'],
                'kuerzel' => $studiengang['kuerzel'],
                'personalnummer' => $studiengang['personalnummer'],
                'neu' => (bool) $studiengang['neu'],
                'id_stufe' => $studiengang['id_stufe'],
            ]);
            DB::statement('ALTER SEQUENCE hls.studiengang_id_studiengang_seq RESTART with 9;');
        }
    }
}
