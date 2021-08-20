<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyProgramSeeder extends Seeder
{
    private $data = [
        ['id' => 3, 'name' => 'MAS Umwelttechnik und -management'],
        ['id' => 4, 'name' => 'Master of Science in Life Sciences'],
        ['id' => 5, 'name' => 'Administration: Allgemein'],
        ['id' => 6, 'name' => 'Bachelor of Science in Life Sciences'],
        ['id' => 7, 'name' => 'Master of Science in Medical Informatics'],
        ['id' => 8, 'name' => 'Weitere Certificates of Advanced Studies'],
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

            DB::table('study_programs')->updateOrInsert(['id' => $entry['id']], $data);
        }

        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");
        if ('pgsql' === $driver) {
            DB::statement('ALTER SEQUENCE "study_programs_id_seq" RESTART WITH '.$lastId + 1);
        }
    }
}
