<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

class BaseCollection extends Collection
{
    public function filterBySemesters(Collection $semesters)
    {
        return $this->filter(function ($entity) use ($semesters) {
            $semester = $entity->semester;
            if (!$semester) {
                return false;
            }

            return $semesters->contains($semester);
        });
    }
}
