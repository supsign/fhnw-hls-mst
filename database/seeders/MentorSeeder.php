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
        $mentorService->createOrUpdateOnEventoPersonId(1, 'Müller', 'Till');
        $mentorService->createOrUpdateOnEventoPersonId(2, 'Meier', 'Max');
        $mentorService->createOrUpdateOnEventoPersonId(3, 'Berger', 'Anna');
    }
}
