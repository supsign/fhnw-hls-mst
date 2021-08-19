<?php

namespace App\Services\Helpers;

use Exception;

trait Hashes
{
    public function getHash(string | int $value)
    {
        $hashSalt = config('jwt.hashSalt');

        return hash('sha3-512', $value.$hashSalt);
    }
}
