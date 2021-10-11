<?php

namespace App\Models;

/**
 * @mixin IdeHelperCompletion
 */
class CompletionType extends BaseModel
{
    public function completions()
    {
        return $this->hasMany(Completion::class);
    }
}
