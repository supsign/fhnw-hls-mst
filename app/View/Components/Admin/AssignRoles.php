<?php

namespace App\View\Components\Admin;

use App\Models\StudyField;
use App\Services\Auth\Role;
use Illuminate\View\Component;
use Spatie\Permission\Models\Permission;

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
            'roles' => Permission::all(),
        ]);
    }
}
