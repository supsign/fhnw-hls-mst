<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Services\Student\StudentService;
use App\Services\User\PermissionAndRoleService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(protected StudentService $studentService, protected PermissionAndRoleService $permissionAndRoleService)
    {
    }

    public function getByEventoId(Request $request)
    {
        $this->permissionAndRoleService->canManageBackendOrAbort();
        return $this->studentService->getByEventoPersonId($request->eventoId);
    }
}
