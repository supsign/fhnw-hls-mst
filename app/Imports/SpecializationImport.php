<?php

namespace App\Imports;

use App;
use App\Services\Specialization\SpecializationService;
use App\Services\SpecializationYear\SpecializationYearService;

class SpecializationImport extends BaseCsvImport
{
    protected SpecializationService $specializationService;
    protected SpecializationYearService $specializationYearService;
    protected $fileNames = ['spezialisierung.csv'];
    protected $fieldAddresses = ['id_spezialisierung', 'bezeichnung', 'id_studienrichtung'];

    public function __construct()
    {
        $this->specializationService = App::make(SpecializationService::class);
        $this->specializationYearService = App::make(SpecializationYearService::class);

        parent::__construct();
    }

    public function importLine()
    {
        if (in_array($this->line['bezeichnung'], ['BZ', 'MI', 'MT', 'PT'])) {
            return $this;
        }

        $specialization = $this->specializationService->firstOrCreate([
            'janis_id' => $this->line['id_spezialisierung'],
            'name' => $this->line['bezeichnung'],
            'study_field_id' => $this->line['id_studienrichtung'],
        ]);

        foreach ($specialization->studyField->studyFieldYears AS $studyFieldYear) {
            $this->specializationYearService->firstOrCreate([
                'specialization_id' => $specialization->id,
                'study_field_year_id' => $studyFieldYear->id,
            ]);
        }
    }
}
