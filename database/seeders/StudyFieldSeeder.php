<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyFieldSeeder extends Seeder
{
    private $data = [
        ['id' => 1, 'name' => 'Chemie', 'study_program_id' => 6],
        ['id' => 2, 'name' => 'Medizintechnik', 'study_program_id' => 6],  
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

            DB::table('study_fields')->updateOrInsert(['id' => $entry['id']], $data);
        }
    }
}
