<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperFrequentlyAskedQuestion
 */
class FrequentlyAskedQuestion extends BaseModel
{
    use SoftDeletes;
}
