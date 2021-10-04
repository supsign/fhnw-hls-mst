<?php

namespace App\Imports;

use App;
use App\Services\CourseCourseGroupYear\CourseCourseGroupYearService;

class CourseCourseGroupYearImporter extends BaseCsvImport
{
    protected CourseCourseGroupYearService $courseCourseGroupYearService;
    protected $fileNames = ['modul_zu_modulgruppe.csv'];
    protected $fieldAddresses = ['laufnummer', 'id_modulgruppe', 'semester'];

    public function __construct()
    {
        $this->courseCourseGroupYearService = App::make(CourseCourseGroupYearService::class);

        parent::__construct();
    }

    public function importLine()
    {

    }
}



