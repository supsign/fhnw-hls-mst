<?php

namespace App\View\Components\Admin;

use App\Models\StudyField;
use Illuminate\View\Component;
use Spatie\Permission\Models\Role;

class AssignRoles extends Component
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
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.assign-roles', [
            'roles' => Role::where('name', '<>', 'server-admin')->get(),
        ]);
    }
}
