<?php

namespace App\Imports;

class CourseSpecializationImport extends BaseCsvImport
{
    protected $fileNames = ['modul_zu_spezialisierung.csv'];
    protected $fieldAddresses = ['id_spezialisierung', 'laufnummer', 'pflicht'];

    public function importLine()
    {
        //  This table doesn't exist anymore? We only have CourseSpecialisationYears
    }
}
