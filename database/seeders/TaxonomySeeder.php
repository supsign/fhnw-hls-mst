<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxonomySeeder extends Seeder
{
    private $data = [
        ['id' => 1, 'name' => 'kennen'],
        ['id' => 2, 'name' => 'verstehen'],
        ['id' => 3, 'name' => 'anwenden'],
        ['id' => 4, 'name' => 'analysieren'],
        ['id' => 5, 'name' => 'beurteilen'],
        ['id' => 6, 'name' => 'erschaffen'],
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
                    $lastId = $value;
                    continue;
                }

                $data[$key] = $value;
            }

            DB::table('taxonomies')->updateOrInsert(['id' => $entry['id']], $data);
        }

        DB::statement('ALTER SEQUENCE "taxonomies_id_seq" RESTART WITH '.$lastId + 1);
    }
}
