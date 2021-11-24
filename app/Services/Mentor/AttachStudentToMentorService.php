<?php

namespace App\Services\Mentor;

use App\Models\Mentor;
use App\Models\MentorStudent;
use App\Models\Student;
use Auth;

class AttachStudentToMentorService
{
    public function __construct(private MentorStudent $mentorStudentModel)
    {
    }

    public function attach(Mentor $mentor, Student $student): MentorStudent
    {
        $user = Auth::user();
        return $this->mentorStudentModel::firstOrCreate(
            [
                'mentor_id' => $mentor->id,
                'student_id' => $student->id,
                'firstname' => $user?->firstname,
                'lastname' => $user?->lastname
            ]
        );
    }

    public function detach(Mentor $mentor, Student $student): void
    {
        $mentorStudent = $this->mentorStudentModel::where(
            [
                'mentor_id' => $mentor->id,
                'student_id' => $student->id,
            ]
        )->first();

        $mentorStudent->delete();
    }
}
