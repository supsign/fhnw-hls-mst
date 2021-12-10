<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\Helpers\Hashes;
use App\Services\Token\ShibbolethProperties;
use App\Services\Token\TokenService;
use App\Services\User\UserService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthService
{
    use Hashes;

    public function __construct(
        protected RoleService $roleService,
        protected UserService $userService,
        protected TokenService $tokenService
    ) {
    }

    public function attempt(string $jwt): bool
    {
        if (!$this->tokenService->isValid($jwt)) {
            return false;
        }

        $this->login(
            $this->tokenService->getShibbolethProperties($jwt)
        );

        return true;
    }

    protected function login(ShibbolethProperties $shibbolethProperties): User
    {
        try {
            $role = $this->roleService->evaluate($shibbolethProperties);
        } catch (\Throwable $th) {
            activity('error')
                ->withProperties($shibbolethProperties)
                ->log('login failed - invalid user role: '.$th->getMessage());

            abort(403, $th->getMessage());
        }

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
            activity('error')
                ->withProperties($shibbolethProperties)
                ->log('login failed - user has not been created');

            throw new Exception('user not created or updated');
        }

        Auth::login($user);
        Session::regenerate();
        Session::put('lastname', $shibbolethProperties->surname);
        Session::put('firstname', $shibbolethProperties->givenName);
        Session::put('email', $shibbolethProperties->mail);

        activity('info')
            ->withProperties($shibbolethProperties)
            ->performedOn($user)
            ->log('login succesful');

        return $user;
    }

    protected function isAuthorizedForLogin(ShibbolethProperties $shibbolethProperties): bool   //  never used anywhere.
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
