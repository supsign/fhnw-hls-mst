<?php

namespace App\Models;

class Mentor extends BaseModel
{
    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

    public function mentorStudent()
    {
    	return $this->hasMany(MentorStudent::class);
    }

    public function students()
    {
    	return $this->belongsToMany(Student::class);
    }
	
	public function users()
	{
		return $this->hasMany(User::class);
	}
}
