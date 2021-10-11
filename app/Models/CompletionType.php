<?php

namespace App\Models;

/**
 * @mixin IdeHelperCompletionType
 */
class CompletionType extends BaseModel
{
    public function completions()
    {
        return $this->hasMany(Completion::class);
    }
}
