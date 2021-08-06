<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
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
     */
    public function run()
    {
        foreach ($this->data as $entry) {
            $data = [];

            foreach ($entry as $key => $value) {
                if ('id' === $key) {
                    continue;
                }

                $data[$key] = $value;
            }

            DB::table('languages')->updateOrInsert(['id' => $entry['id']], $data);
        }
    }
}
