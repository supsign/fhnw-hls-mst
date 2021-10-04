<?php

namespace App\Imports;

use App\Models\CrossQualification;

class CrossQualificationImport extends BaseCsvImport
{
    protected $fileNames = ['querschnittsqualifikation.csv'];
    protected $fieldAddresses = ['id_querschnittsqualifikation', 'bezeichnung', 'id_studienrichtung'];

    public function importLine()
    {
        CrossQualification::create([
            'name' => $this->line['bezeichnung'],
            'study_field_id' => $this->line['id_studienrichtung'],
        ]);

        return $this;
    }
}
