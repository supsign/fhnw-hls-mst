<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class AddStufeSeeder extends Seeder
{
    private $stufen = [
        ['id_stufe' => '1', 'stufe' => 'Bachelor', 'kuerzel' => 'B'],
        ['id_stufe' => '2', 'stufe' => 'Master of Advanced Studies', 'kuerzel' => 'W'],
        ['id_stufe' => '3', 'stufe' => 'Consecutive Master', 'kuerzel' => 'M'],
        ['id_stufe' => '4', 'stufe' => 'Vermischt', 'kuerzel' => null],
    ];

    /**
     * Run the database seeds.
     */
    public function run()
    {
        foreach ($this->stufen as $stufe) {
            DB::table('hls.stufe')->updateOrInsert([
                'id_stufe' => $stufe['id_stufe'],
            ], [
                'stufe' => $stufe['stufe'],
                'kuerzel' => $stufe['kuerzel'],
            ]);
            DB::statement('ALTER SEQUENCE hls.stufe_id_stufe_seq RESTART with 5;');
        }
    }
}
