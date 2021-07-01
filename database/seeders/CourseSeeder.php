<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    private $data = [
        ['id' => 1, 'number' => 'A1', 'langauge_id' => 1, 'course_type_id' => 1],
        ['id' => 2, 'number' => 'B2', 'langauge_id' => 2, 'course_type_id' => 3],
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

            DB::table('courses')->updateOrInsert(['id' => $entry['id']], $data);
        }
    }
}
