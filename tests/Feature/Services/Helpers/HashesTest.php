<?php

namespace Tests\Feature\Services\helpers;

use App\Models\Mentor;
use App\Services\Helpers\hashes;
use Exception;
use Tests\TestCase;
use TypeError;

/**
 * @internal
 * @coversNothing
 */
class HashesTest extends TestCase
{
    use Hashes;

    public function testGetHashFromString()
    {
        $hash = $this->getHash('blub');
        $this->assertIsString($hash);
        $this->assertTrue(strlen($hash) === 128);
    }

    public function testGetHashFromInt()
    {
        $hash = $this->getHash(1234);
        $this->assertIsString($hash);
        $this->assertTrue(strlen($hash) === 128);
    }

    public function testGetHashFromNull()
    {
        $mentor = new Mentor();
        $this->expectException(TypeError::class);
        $this->getHash($mentor->blub);       
    }

}
