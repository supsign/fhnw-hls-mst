<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCrossQualificationYear extends Model
{
    protected $table = 'course_cross_qualification_year';

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function crossQualification()
    {
        return $this->belongsTo(CrossQualification::class);
    }
}
