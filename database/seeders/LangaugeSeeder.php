<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LangaugeSeeder extends Seeder
{
    private $data = [
        ['id' => 1, 'name' => 'Deutsch'],
        ['id' => 2, 'name' => 'Englisch'],
        ['id' => 3, 'name' => 'Deutsch oder Englisch'],
        ['id' => 4, 'name' => 'Französisch'],
        ['id' => 5, 'name' => 'Italienisch'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $entry) {
            $data = array();

            foreach ($entry AS $key => $value) {
                if ($key === 'id') {
                    continue;
                }

                $data[$key] = $value;
            }

            DB::table('langauges')->updateOrInsert(['id' => $entry['id']], $data);
        }
    }
}
