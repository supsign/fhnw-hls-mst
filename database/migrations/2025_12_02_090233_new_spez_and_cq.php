<?php

use App\Models\CrossQualification;
use App\Models\CrossQualificationYear;
use App\Models\Specialization;
use App\Models\SpecializationYear;
use App\Models\StudyFieldYear;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    public function up()
    {
        $ut = StudyFieldYear::find(50);

        foreach (['UT - Umweltwissenschaften', 'UT - Umweltingenieurswesen'] as $specialisationName) {
            $spec = Specialization::firstOrCreate([
                'name' => $specialisationName,
                'study_field_id' => $ut->study_field_id,
            ]);

            SpecializationYear::firstOrCreate([
                'specialization_id' => $spec->id,
                'study_field_year_id' => $ut->id,
            ]);
        }

        foreach (['UT - Digitalisierung'] as $crossQualificationName) {
            $cq = CrossQualification::firstOrCreate([
                'name' => $crossQualificationName,
                'study_field_id' => $ut->study_field_id,
            ]);

            CrossQualificationYear::firstOrCreate([
                'cross_qualification_id' => $cq->id,
                'study_field_year_id' => $ut->id,
            ]);
        }

        $ce24 = StudyFieldYear::find(45);

        foreach (['CE - Digitalisierung'] as $crossQualificationName) {
            $cq = CrossQualification::firstOrCreate([
                'name' => $crossQualificationName,
                'study_field_id' => $ce24->study_field_id,
            ]);

            CrossQualificationYear::firstOrCreate([
                'cross_qualification_id' => $cq->id,
                'study_field_year_id' => $ce24->id,
            ]);
        }

        $ce25 = StudyFieldYear::find(53);

        foreach (['CE - Digitalisierung'] as $crossQualificationName) {
            $cq = CrossQualification::firstOrCreate([
                'name' => $crossQualificationName,
                'study_field_id' => $ce25->study_field_id,
            ]);

            CrossQualificationYear::firstOrCreate([
                'cross_qualification_id' => $cq->id,
                'study_field_year_id' => $ce25->id,
            ]);
        }
    }
};
