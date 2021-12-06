<?php

namespace Database\Seeders;

use App\Services\Mentor\MentorService;
use App\Services\StudyField\StudyFieldService;
use Illuminate\Database\Seeder;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(MentorService $mentorService, StudyFieldService $studyFieldService)
    {
        $mentorService->addStudyField(
            $degen = $mentorService->createOrUpdateOnEventoPersonId(453149, 'Degen', 'Markus'),
            $medInfo = $studyFieldService->getByEventoId(9304956)
        );

        $mentorService->addStudyField(
            $degen,
            $medTech = $studyFieldService->getByEventoId(9309072)
        );

        $mentorService->addStudyField(
            $hemm = $mentorService->createOrUpdateOnEventoPersonId(764996, 'Hemm-Ode', 'Simone'),
            $medInfo,
            true
        );

        $mentorService->addStudyField(
            $hemm,
            $medTech,
            true
        );

        $mentorService->addStudyField(
            $germers = $mentorService->createOrUpdateOnEventoPersonId(928678, 'Germershaus', 'Oliver'),
            $studyFieldService->getByEventoId(9311288)
        );

        $mentorService->addStudyField(
            $germers,
            $studyFieldService->getByEventoId(9311111)
        );

        $mentorService->addStudyField(
            $mentorService->createOrUpdateOnEventoPersonId(10075603, 'Langer', 'Miriam'),
            $studyFieldService->getByEventoId(9310716)
        );

        $mentorService->addStudyField(
            $gotz = $mentorService->createOrUpdateOnEventoPersonId(7631, 'Schlotterbeck', 'Götz'),
            $zellBio = $studyFieldService->getByEventoId(9311263)
        );

        $mentorService->addStudyField(
            $gotz,
            $chemie = $studyFieldService->getByEventoId(9311212)
        );

        $mentorService->addStudyField(
            $sauter = $mentorService->createOrUpdateOnEventoPersonId(889620, 'Suter-Dick', 'Laura'),
            $zellBio,
            true
        );

        $mentorService->addStudyField(
            $sauter,
            $chemie,
            true
        );
    }
}
