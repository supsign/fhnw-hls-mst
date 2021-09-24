<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    protected $fillable = ['email_hash'];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    protected function getEmailAttribute(): ?string     //  ToDo: mock properties from shibboleth request
    {
        return 'mail@exmaple.com';
    }

    protected function getFirstnameAttribute(): ?string
    {
        return 'Firstname';
    }

    protected function getLastnameAttribute(): ?string
    {
        return 'Lastname';
    }
}
