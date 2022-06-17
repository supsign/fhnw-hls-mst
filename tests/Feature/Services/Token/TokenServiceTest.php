<?php

namespace Tests\Feature\Services\Token;

use App\Services\Token\ShibbolethProperties;
use App\Services\Token\TokenService;
use Illuminate\Foundation\Testing\WithFaker;
use Lcobucci\JWT\Token;
use Lcobucci\JWT\Token\Plain;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class TokenServiceTest extends TestCase
{
    use WithFaker;
    protected TokenService $tokenService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->tokenService = $this->app->make(TokenService::class);
    }

    public function testParseToken()
    {
        $jwt = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c';
        $token = $this->invokeMethod($this->tokenService, 'parse', [$jwt]);
        $this->assertInstanceOf(Token::class, $token);
    }

    public function testInvalidateRandomToken()
    {
        $jwt = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c';
        $isValid = $this->tokenService->isValid($jwt);
        $this->assertFalse($isValid);
    }

    public function testIssueTestTokenStudent()
    {
        $shibbolethProperties = new ShibbolethProperties();
        $shibbolethProperties->mail = $this->faker->email();
        $shibbolethProperties->fhnwIDPerson = $this->faker->randomNumber(5);
        $shibbolethProperties->fhnwDetailedAffiliation = 'staff-hls-alle;sldkjf;aslkdfj';
        $token = $this->tokenService->issue($shibbolethProperties);
        $this->assertInstanceOf(Plain::class, $token);
    }

    public function testValidateToken()
    {
        $shibbolethProperties = new ShibbolethProperties();
        $shibbolethProperties->mail = $this->faker->email();
        $shibbolethProperties->fhnwIDPerson = $this->faker->randomNumber(5);
        $shibbolethProperties->fhnwDetailedAffiliation = 'staff-hls-alle;sldkjf;aslkdfj';
        $token = $this->tokenService->issue($shibbolethProperties);
        $isValid = $this->tokenService->isValid($token->toString());
        $this->assertTrue($isValid);
    }
}
