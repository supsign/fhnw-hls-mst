<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompletionTypeSeeder extends Seeder
{
    private $data = [
        ['id' => 1, 'name' => 'angemeldet'],
        ['id' => 2, 'name' => 'bestanden'],
        ['id' => 3, 'name' => 'durchgefallen'],
        ['id' => 4, 'name' => 'angerechnet'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
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

            DB::table('completion_types')->updateOrInsert(['id' => $entry['id']], $data);
        }

        $connection = config('database.default');
        $driver = config("database.connections.{$connection}.driver");
        if ('pgsql' === $driver) {
            DB::statement('ALTER SEQUENCE "completion_types_id_seq" RESTART WITH '.$lastId + 1);
        }
    }
}
