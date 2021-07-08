<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseTypeSeeder extends Seeder
{
    private $data = [
        ['id' => 1, 'name' => 'Vorlesung'],
        ['id' => 2, 'name' => 'Praktikum'],
        ['id' => 3, 'name' => 'Laborpraktikum'],
        ['id' => 4, 'name' => 'Studierendenprojekt'],
        ['id' => 5, 'name' => 'Bachelor-Thesis'],
        ['id' => 6, 'name' => 'Bachelor-Thesis (lang)'],
        ['id' => 7, 'name' => 'Master-Thesis'],
        ['id' => 8, 'name' => 'Prüfung'],
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

            DB::table('course_types')->updateOrInsert(['id' => $entry['id']], $data);
        }
    }
}
