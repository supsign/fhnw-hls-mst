<?php

namespace App\Models;

/**
 * @mixin IdeHelperMentorStudent
 */
class MentorStudent extends BaseModel
{
    protected $table = 'mentor_student';

    public function mentor()
    {
    	return $this->belongsTo(Mentor::class);
    }

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }
}
