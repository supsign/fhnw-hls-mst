<?php

namespace App\Http\Controllers\WebApi;

use App\Http\Controllers\Controller;
use App\Services\Student\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(protected StudentService $studentService)
    {
    }

    public function getByEventoId(Request $request)
    {
        return $this->studentService->getByEventoPersonId($request->eventoId);
    }
}
