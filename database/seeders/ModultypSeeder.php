<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ModultypSeeder extends Seeder
{
    private $modultypen = [
        ['id_modultyp' => '1', 'bezeichnung' => 'Vorlesung'],
        ['id_modultyp' => '2', 'bezeichnung' => 'Praktikum'],
        ['id_modultyp' => '3', 'bezeichnung' => 'Laborpraktikum'],
        ['id_modultyp' => '4', 'bezeichnung' => 'Studierendenprojekt'],
        ['id_modultyp' => '5', 'bezeichnung' => 'Bachelor-Thesis'],
        ['id_modultyp' => '6', 'bezeichnung' => 'Bachelor-Thesis (lang)'],
        ['id_modultyp' => '7', 'bezeichnung' => 'Master-Thesis'],
    ];

    public function run()
    {
        foreach ($this->modultypen as $modultyp) {
            DB::table('hls.modultyp')->updateOrInsert([
                'id_modultyp' => $modultyp['id_modultyp'],
            ], [
                'bezeichnung' => $modultyp['bezeichnung'],
            ]);
            DB::statement('ALTER SEQUENCE hls.modultyp_id_modultyp_seq RESTART with 8;');
        }
    }
}
