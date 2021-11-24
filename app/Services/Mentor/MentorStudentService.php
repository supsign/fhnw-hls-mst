<?php

namespace App\Services\Mentor;

use App\Models\Mentor;
use App\Models\MentorStudent;
use App\Models\Student;
use App\Services\Base\BaseModelService;

class MentorStudentService extends BaseModelService
{
    public function __construct(protected MentorStudent $model)
    {
        parent::__construct($model);
    }

    public function getByMentorAndStudent(Mentor $mentor = null, Student $student = null): ?MentorStudent
    {
        if (!$mentor || !$student) {
            return null;
        }

        return $this->model::where(['mentor_id' => $mentor->id, 'student_id' => $student->id])->first();
    }
}
