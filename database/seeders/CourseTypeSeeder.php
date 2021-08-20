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

            DB::table('course_types')->updateOrInsert(['id' => $entry['id']], $data);
        }

        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");
        if ('pgsql' === $driver) {
            DB::statement('ALTER SEQUENCE "course_types_id_seq" RESTART WITH '.$lastId + 1);
        }
    }
}
