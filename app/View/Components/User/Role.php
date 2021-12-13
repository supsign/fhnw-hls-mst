<?php

namespace App\View\Components\User;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Role extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
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
        $roles = Auth::user()->roles->where('id', '!==', 1);
        foreach ($roles as $role) {
            if ($role->name === 'app-admin') {
                $role->name = 'App-Admin';
            }
            if ($role->name === 'server-admin') {
                $role->name = 'Super-Admin';
            }
            if ($role->name === 'mentor') {
                $role->name = 'Mentor';
            }
        }

        return view('components.user.role', [
            'roles' => $roles,
        ]);
    }
}
