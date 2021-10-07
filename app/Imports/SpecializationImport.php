<?php

namespace App\Imports;

use App;
use App\Services\Specialization\SpecializationService;

class SpecializationImport extends BaseCsvImport
{
    protected SpecializationService $specializationService;
    protected $fileNames = ['spezialisierung.csv'];
    protected $fieldAddresses = ['id_spezialisierung', 'bezeichnung', 'id_studienrichtung'];

    public function __construct()
    {
        $this->specializationService = App::make(SpecializationService::class);

        parent::__construct();
    }

    public function importLine()
    {
        if (in_array($this->line['bezeichnung'], ['BZ', 'MI', 'MT', 'PT'])) {
            return $this;
        }

        $this->specializationService->firstOrCreate([
            'name' => $this->line['bezeichnung'],
            'study_field_id' => $this->line['id_studienrichtung'],
        ]);
    }
}
