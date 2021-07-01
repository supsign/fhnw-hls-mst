<?php

namespace App\Models;

class Specialization extends BaseModel
{
    public function plannings()
    {
        return $this->hasMany(Plannings::class);
    }
    
    public function recommendations()
    {
    	return $this->hasMany(Recommendation::class);
    }
}
