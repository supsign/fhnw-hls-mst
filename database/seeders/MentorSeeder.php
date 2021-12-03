<?php

namespace Database\Seeders;

use App\Services\Mentor\MentorService;
use Illuminate\Database\Seeder;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(MentorService $mentorService)
    {
        $mentorService->createOrUpdateOnEventoPersonId(453149, 'Degen', 'Markus');
        $mentorService->createOrUpdateOnEventoPersonId(764996, 'Hemm-Ode', 'Simone');
        $mentorService->createOrUpdateOnEventoPersonId(928678, 'Germershaus', 'Oliver');
        $mentorService->createOrUpdateOnEventoPersonId(10075603, 'Langer', 'Miriam');
        $mentorService->createOrUpdateOnEventoPersonId(7631, 'Schlotterbeck', 'Götz');
        $mentorService->createOrUpdateOnEventoPersonId(889620, 'Suter-Dick', 'Laura');
    }
}
