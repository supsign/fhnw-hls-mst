<?php

namespace App\Imports;

use App\Models\CrossQualification;
use App\Models\CrossQualificationYear;

class CrossQualificationImport extends BaseCsvImport
{
    protected $fileNames = ['querschnittsqualifikation.csv'];
    protected $fieldAddresses = ['id_querschnittsqualifikation', 'bezeichnung', 'id_studienrichtung'];

    public function importLine()
    {
        $crossQualification = CrossQualification::create([
            'janis_id' => $this->line['id_querschnittsqualifikation'],
            'name' => $this->line['bezeichnung'],
            'study_field_id' => $this->line['id_studienrichtung'],
        ]);

        foreach ($crossQualification->studyField->studyFieldYears AS $studyFieldYear) {
            CrossQualificationYear::firstOrCreate([
                'cross_qualification_id' => $crossQualification->id,
                'study_field_year_id' => $studyFieldYear->id,
            ]);
        }

        return $this;
    }

    public function countAmountToPAss()
    {
        foreach (CrossQualificationYear::all() AS $crossQualifcationYear) {
            $crossQualifcationYear->update([
                'amount_to_pass' => $crossQualifcationYear->courses()->count(),
            ]);
        }

        return $this;
    }
}
