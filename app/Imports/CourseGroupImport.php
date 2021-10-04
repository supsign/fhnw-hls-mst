<?php

namespace App\Imports;

use App;
use App\Services\CourseGroup\CourseGroupService;

class CourseGroupImport extends BaseCsvImport
{
    protected CourseGroupService $courseGroupService;
    protected $fileNames = ['modulgruppe.csv'];
    protected $fieldAddresses = ['modulgruppenbezeichnung', 'id_modulgruppe', 'beschreibung', 'kuerzel', 'neu'];

    public function __construct()
    {
        $this->courseGroupService = App::make(CourseGroupService::class);

        parent::__construct();
    }

    public function importLine()
    {
        $this->courseGroupService->UpdateOrCreateByImportId(
            $this->line['id_modulgruppe'],
            [
                'name' => $this->line['modulgruppenbezeichnung'],
            ]
        );
    }
}



