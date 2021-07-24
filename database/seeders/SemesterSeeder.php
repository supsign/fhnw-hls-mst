<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SemesterSeeder extends Seeder
{
    private $data = [
        ['id' => 1, 'year' => 2021, 'start_date' => '2021-01-01'],
        ['id' => 2, 'year' => 2021, 'start_date' => '2021-07-01', 'is_hs' => true, 'previous_semester_id' => 1],
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

            DB::table('semesters')->updateOrInsert(['id' => $entry['id']], $data);
        }
    }
}
