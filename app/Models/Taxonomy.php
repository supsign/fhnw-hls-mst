<?php

namespace App\Models;

class Taxonomy extends BaseModel
{
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
