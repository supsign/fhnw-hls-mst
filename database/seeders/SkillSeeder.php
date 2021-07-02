<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillSeeder extends Seeder
{
    private $data = [
        ['id' => 1, 'definition' => 'sind fähig den zweiten Hauptsatz der Thermodynamik auf Mischphasen anzuwenden', 'taxonomy_id' => 3],
        ['id' => 2, 'definition' => 'verstehen das Konzept der partiellen molaren Grössen', 'taxonomy_id' => 2],
        ['id' => 3, 'definition' => 'können das Konzept des chemischen Potentials auf das Gleichgewicht von Mischphasen und das chemische Gleichgewicht anwenden.', 'taxonomy_id' => 3],
        ['id' => 4, 'definition' => 'können für einfache Beispiele die Lage des chemischen Gleichgewichts berechnen', 'taxonomy_id' => 3],
        ['id' => 5, 'definition' => 'können einfache Phasendiagramme gas/flüssig interpretieren', 'taxonomy_id' => 2],
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

            DB::table('skills')->updateOrInsert(['id' => $entry['id']], $data);
        }
    }
}
