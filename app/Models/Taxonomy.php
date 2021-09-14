<?php

namespace App\Models;

/**
 * @mixin IdeHelperTaxonomy
 */
class Taxonomy extends BaseModel
{
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }
}
