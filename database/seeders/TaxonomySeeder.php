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
     */
    public function run()
    {
        foreach ($this->data as $entry) {
            $data = [];

            foreach ($entry as $key => $value) {
                if ('id' === $key) {
                    $lastId = $value;

                    continue;
                }

                $data[$key] = $value;
            }

            DB::table('taxonomies')->updateOrInsert(['id' => $entry['id']], $data);
        }

        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");
        if ('pgsql' === $driver) {
            DB::statement('ALTER SEQUENCE "taxonomies_id_seq" RESTART WITH '.$lastId + 1);
        }
    }
}
