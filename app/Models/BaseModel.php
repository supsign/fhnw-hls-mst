<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperBaseModel
 */
class BaseModel extends Model
{
    use HasFactory;

    protected $guarded = [];
}
