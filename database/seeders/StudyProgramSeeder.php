<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyProgramSeeder extends Seeder
{
    private $data = [
        ['id' => 1, 'name' => 'MAS Umwelttechnik und -management'],
        ['id' => 2, 'name' => 'Master of Science in Life Sciences'],
        ['id' => 3, 'name' => 'Administration: Allgemein'],
        ['id' => 4, 'name' => 'Bachelor of Science in Life Sciences'],
        ['id' => 5, 'name' => 'Master of Science in Medical Informatics'],
        ['id' => 6, 'name' => 'Weitere Certificates of Advanced Studies'],
        ['id' => 7, 'name' => ''],
        ['id' => 8, 'name' => ''],
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

            DB::table('study_programs')->updateOrInsert(['id' => $entry['id']], $data);
        }
    }
}
