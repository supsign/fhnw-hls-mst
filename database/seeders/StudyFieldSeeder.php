<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyFieldSeeder extends Seeder
{
    private $data = [
        ['id' => 7, 'name' => 'MAS Umwelttechnik und -management', 'study_program_id' => 3],
        ['id' => 8, 'name' => 'Pharmatechnologie', 'study_program_id' => 6],
        ['id' => 9, 'name' => 'Umwelttechnologie', 'study_program_id' => 6],
        ['id' => 11, 'name' => 'Medizininformatik', 'study_program_id' => 6],
        ['id' => 12, 'name' => 'Medizintechnik', 'study_program_id' => 6],
        ['id' => 13, 'name' => 'Chemie', 'study_program_id' => 6],
        ['id' => 14, 'name' => 'Bioanalytik und Zellbiologie', 'study_program_id' => 6],
        ['id' => 15, 'name' => 'Chemie- und Bioprozesstechnik', 'study_program_id' => 6],
        ['id' => 17, 'name' => 'Biomedical Engineering', 'study_program_id' => 4],
        ['id' => 18, 'name' => 'Chemistry', 'study_program_id' => 4],
        ['id' => 19, 'name' => 'Bioanalytics', 'study_program_id' => 4],
        ['id' => 20, 'name' => 'Pharmatechnology', 'study_program_id' => 4],
        ['id' => 21, 'name' => 'Environmental Technologies', 'study_program_id' => 4],
        ['id' => 23, 'name' => 'Master of Science in Medical Informatics', 'study_program_id' => 7],
        ['id' => 26, 'name' => 'Administration: MScMI', 'study_program_id' => 7],
        ['id' => 27, 'name' => 'Administration: MASU', 'study_program_id' => 3],
        ['id' => 28, 'name' => 'Administration: BScLS', 'study_program_id' => 6],
        ['id' => 31, 'name' => 'Administration: MScLS', 'study_program_id' => 4],
        ['id' => 32, 'name' => 'Administration: Allgemein', 'study_program_id' => 5],
        ['id' => 34, 'name' => 'CAS Clinical, Regulatory and Quality Affairs for Medical Devices and In-Vitro Diagnostics', 'study_program_id' => 8],
        ['id' => 35, 'name' => 'CAS Molekulare Diagnostik', 'study_program_id' => 8],
        ['id' => 36, 'name' => 'CAS Quality Manager Pharma', 'study_program_id' => 8],
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
                    $lastId = $value;
                    continue;
                }

                $data[$key] = $value;
            }

            DB::table('study_fields')->updateOrInsert(['id' => $entry['id']], $data);
        }

        DB::statement('ALTER SEQUENCE "study_fields_id_seq" RESTART WITH '.$lastId + 1);
    }
}
