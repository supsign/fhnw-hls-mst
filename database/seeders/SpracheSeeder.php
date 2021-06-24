<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class SpracheSeeder extends Seeder
{
    private $spracheen = [
        ['id_sprache' => '1', 'sprache' => 'Deutsch'],
        ['id_sprache' => '2', 'sprache' => 'Englisch'],
        ['id_sprache' => '3', 'sprache' => 'Deutsch oder Englisch'],
        ['id_sprache' => '4', 'sprache' => 'Französisch'],
        ['id_sprache' => '5', 'sprache' => 'Italienisch'],
        ['id_sprache' => '6', 'sprache' => 'Deutsch mit englischen Unterlagen'],
    ];

    public function run()
    {
        foreach ($this->spracheen as $sprache) {
            DB::table('hls.sprache')->updateOrInsert([
                'id_sprache' => $sprache['id_sprache'],
            ], [
                'sprache' => $sprache['sprache'],
            ]);
            DB::statement('ALTER SEQUENCE hls.sprache_id_sprache_seq RESTART with 7;');
        }
    }
}
