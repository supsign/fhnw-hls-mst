<?php

namespace App\View\Components\User;

use App\Models\User;
use App\Services\Student\StudentEctsService;
use Auth;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Userdata extends Component
{
    public $ects;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(StudentEctsService $studentEctsService)
    {
        $user = Auth::user();
        $this->ects = $studentEctsService->getPointsAsString($user->student);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.user.userdata', [
            'users' => User::all(),
        ]);
    }
}
