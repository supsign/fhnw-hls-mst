<?php

namespace App\Models;

class Specialization extends BaseModel
{
    public function recommendations()
    {
    	return $this->hasMany(Recommendation::class);
    }
}
