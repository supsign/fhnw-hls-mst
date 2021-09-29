<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    private $data = [
        ['id' => 1, 'year' => 2021, 'start_date' => '2021-01-01', 'is_hs' => false,],
        ['id' => 2, 'year' => 2021, 'start_date' => '2021-07-01', 'previous_semester_id' => 1],
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

            DB::table('semesters')->updateOrInsert(['id' => $entry['id']], $data);
        }

        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");

        if ('pgsql' === $driver) {
            DB::statement('ALTER SEQUENCE "semesters_id_seq" RESTART WITH '.$lastId + 1);
        }
    }
}
