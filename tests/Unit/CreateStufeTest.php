<?php

namespace Tests\Unit;

use App\Models\Stufe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class CreateStufeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function testSaveStufeInDb()
    {
        $stufe = Stufe::create(['stufe' => 'blub']);
        $getStufe = Stufe::find($stufe->id_stufe);
        $this->assertTrue((bool) $getStufe);
    }
}
