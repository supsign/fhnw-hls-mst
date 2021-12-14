<?php

namespace App\View\Components\User;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Role extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        $roles = $this->user->roles->where('id', '!==', 1);
        $customizedRoles = [];

        foreach ($roles as $role) {
            if ($role->name === 'app-admin') {
                $customizedRoles[] = 'App-Admin';
            }
            if ($role->name === 'server-admin') {
                $customizedRoles[] = 'Super-Admin';
            }
            if ($role->name === 'mentor') {
                $customizedRoles[] = 'STGL';
            }
        }

        if ($customizedRoles) {
            return view('components.user.role', [
                'roles' => $customizedRoles,
            ]);
        } else {
            return null;
        }
    }
}
