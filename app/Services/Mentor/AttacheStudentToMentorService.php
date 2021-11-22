<?php

namespace App\Services\Mentor;

use App\Models\Mentor;
use App\Models\MentorStudent;
use App\Models\Student;

class AttacheStudentToMentorService
{
    public function __construct(private MentorStudent $mentorStudentModel)
    {
    }

    public function attache(Mentor $mentor, Student $student): MentorStudent
    {
        return $this->mentorStudentModel::firstOrCreate(
            [
                'mentor_id' => $mentor->id,
                'student_id' => $student->id
            ]
        );
    }

    public function detach(Mentor $mentor, Student $student): void
    {
        $mentorStudent = $this->mentorStudentModel::where(
            [
                'mentor_id' => $mentor->id,
                'student_id' => $student->id
            ]
        )->first();

        $mentorStudent->delete();
    }
}
