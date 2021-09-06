<?php

namespace App\Models;

/**
 * @mixin IdeHelperLanguage
 */
class Language extends BaseModel
{
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
