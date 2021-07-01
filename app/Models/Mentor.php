<?php

namespace App\Models;

class Mentor extends BaseModel
{
	public function users()
	{
		return $this->hasMany(User::class);
	}
}
