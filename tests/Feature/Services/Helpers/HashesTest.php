<?php

namespace Tests\Feature\Services\Helpers;

use App\Models\Mentor;
use App\Services\Helpers\Hashes;
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
        $this->assertTrue(128 === strlen($hash));
    }

    public function testGetHashFromInt()
    {
        $hash = $this->getHash(1234);
        $this->assertIsString($hash);
        $this->assertTrue(128 === strlen($hash));
    }

    public function testGetHashFromNull()
    {
        $mentor = new Mentor();
        $this->expectException(TypeError::class);
        $this->getHash($mentor->blub);
    }
}
