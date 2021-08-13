<?php

namespace App\Services\Helpers;

trait hashes
{
    public function getHash(string | int $value)
    {
        $hashSalt = config('jwt.hashSalt');

        return hash('sha3-512', $value);
    }
}
