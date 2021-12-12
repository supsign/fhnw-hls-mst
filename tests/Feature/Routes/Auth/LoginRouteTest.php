<?php

namespace Tests\Feature\Routes\Auth;

use App\Services\Token\ShibbolethProperties;
use App\Services\Token\TokenService;
use Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
class LoginRouteTest extends TestCase
{
    use WithFaker;

    protected TokenService $tokenService;

    public function setup(): void
    {
        parent::setUp();
        $this->setUpFaker();
        $this->tokenService = $this->app->make(TokenService::class);
    }

    public function testInvalidLogin()
    {
        $jwt = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c';
        $response = $this->post(route('post.auth.login'), ['jwt' => $jwt]);
        $response->assertStatus(403);
    }

    public function testValidLogin()
    {
        $shibbolethProperties = new ShibbolethProperties();
        $shibbolethProperties->mail = $this->faker->email;
        $shibbolethProperties->fhnwIDPerson = $this->faker->randomNumber(5);
        $shibbolethProperties->entitlement = 'http://fhnw.ch/aai/res/hls/stab/mst_edu_student';
        $token = $this->tokenService->issue($shibbolethProperties);
        $response = $this->post(route('post.auth.login'), ['jwt' => $token->toString()]);
        $response->assertStatus(302);
        $this->assertTrue(Auth::check());
    }
}
