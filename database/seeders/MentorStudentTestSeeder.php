<?php

namespace Database\Seeders;

use App\Services\Mentor\AttachStudentToMentorService;
use App\Services\Mentor\MentorService;
use App\Services\Student\StudentService;
use Illuminate\Database\Seeder;

class MentorStudentTestSeeder extends Seeder
{
    private $data = [
        ['mentor_evento_id' => 453149,
            'student_evento_id' => 10059625,
            'firstname' => 'Barbara',
            'lastname' => 'Grossenbacher', ],
        ['mentor_evento_id' => 928678,
            'student_evento_id' => 10072421,
            'firstname' => 'Lukas',
            'lastname' => 'Huber', ],
        ['mentor_evento_id' => 764996,
            'student_evento_id' => 10105855,
            'firstname' => 'Anja',
            'lastname' => 'Fricker', ],
        ['mentor_evento_id' => 10075603,
            'student_evento_id' => 10101732,
            'firstname' => 'Felix',
            'lastname' => 'Bader', ],
        ['mentor_evento_id' => 7631,
            'student_evento_id' => 10077679,
            'firstname' => 'Gabriel',
            'lastname' => 'Müller', ],
        ['mentor_evento_id' => 889620,
            'student_evento_id' => 10071359,
            'firstname' => 'Anna',
            'lastname' => 'Furler', ],

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(MentorService $mentorService, StudentService $studentService, AttachStudentToMentorService $attachStudentToMentorService)
    {
        foreach ($this->data as $mentoStudentInfo) {
            $admin = $mentorService->getById(1);
            $mentor = $mentorService->getByEventoPersonId($mentoStudentInfo['mentor_evento_id']);
            $student = $studentService->getByEventoPersonId($mentoStudentInfo['student_evento_id']);
            $attachStudentToMentorService->attach($mentor, $student, $mentoStudentInfo['firstname'], $mentoStudentInfo['lastname']);
            $attachStudentToMentorService->attach($admin, $student, $mentoStudentInfo['firstname'], $mentoStudentInfo['lastname']);
        }
    }
}
