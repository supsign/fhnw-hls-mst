<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Helpers\hashes;
use App\Services\Token\ShibbolethProperties;
use App\Services\Token\TokenService;
use App\Services\User\UserService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthService
{
    use hashes;

    public function __construct(
        private RoleService $roleService,
        private UserService $userService,
        private TokenService $tokenService
    ) {
    }

    public function attempt(string $jwt): bool
    {
        if (!$this->tokenService->isValid($jwt)) {
            return false;
        }

        $shibbolethProperties = $this->tokenService->getShibbolethProperties($jwt);
        $this->login($shibbolethProperties);

        return true;
    }

    private function login(ShibbolethProperties $shibbolethProperties): User
    {
        try {
            $role = $this->roleService->evaluate($shibbolethProperties);
        } catch (\Throwable $th) {
            abort(403, $th->getMessage());
        }

        var_dump($role);

        switch ($role) {
            case 'student':
                $user = $this->userService->updateOrCreateUserAsStudent(
                    email: $shibbolethProperties->mail,
                    eventoPersonId: $shibbolethProperties->fhnwIDPerson
                );
                break;

            case 'mentor':
                $user = $this->userService->udpateOrCreateAsMentor(
                    email: $shibbolethProperties->mail,
                    eventoPersonId: $shibbolethProperties->fhnwIDPerson,
                    firstname: $shibbolethProperties->givenName,
                    lastname: $shibbolethProperties->surname
                );
                break;

            case 'app-admin':
                $user = $this->userService->updateOrCreateAsAppAdmin(
                    email: $shibbolethProperties->mail,
                    eventoPersonId: $shibbolethProperties->fhnwIDPerson,
                    firstname: $shibbolethProperties->givenName,
                    lastname: $shibbolethProperties->surname
                );
                break;
        }

        if (empty($user)) {
            throw new Exception('user not created or updated');
        }

        Auth::login($user);
        Session::regenerate();
        Session::put('lastname', $shibbolethProperties->surname);
        Session::put('firstname', $shibbolethProperties->givenName);
        Session::put('email', $shibbolethProperties->mail);

        return $user;
    }

    private function isAuthorizedForLogin(ShibbolethProperties $shibbolethProperties)
    {
        if (!$shibbolethProperties->mail) {
            return false;
        }

        if (!$shibbolethProperties->fhnwIDPerson) {
            return false;
        }

        return true;
    }
}
