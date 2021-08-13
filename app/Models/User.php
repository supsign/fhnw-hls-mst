<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
