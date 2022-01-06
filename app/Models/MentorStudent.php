<?php

namespace App\Models;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

/**
 * @mixin IdeHelperMentorStudent
 */
class MentorStudent extends BaseModel
{
    protected $table = 'mentor_student';

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getFirstnameAttribute(string $value = null)
    {
        return $this->getDecrypted($value);

    }

    public function setFirstnameAttribute(string $value = null)
    {
        $this->attributes['firstname'] = $this->getEncrypted($value);
    }

    public function getLastnameAttribute(string $value = null)
    {
        return $this->getDecrypted($value);

    }

    public function setLastnameAttribute(string $value = null)
    {
        $this->attributes['lastname'] = $this->getEncrypted($value);
    }

    private function getDecrypted(string $value = null){
        if (!$value) {
            return $value;
        }

        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $err) {
            return $value;
        }
    }

    private function getEncrypted(string $value = null){
        if (!$value) {
            return $value;
        }

        return Crypt::encryptString($value);
    }
}
