<?php

namespace App\Services\Planning;

use App\Models\Planning;

class LockPlanningService
{
    public function lock(Planning $planning): Planning
    {
        $planning->is_locked = true;
        $planning->save();

        return $planning;
    }

    public function unLock(Planning $planning): Planning
    {
        $planning->is_locked = false;
        $planning->save();

        return $planning;
    }
}
