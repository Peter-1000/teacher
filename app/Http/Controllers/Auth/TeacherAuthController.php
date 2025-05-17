<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TeacherLoginRequest;
use App\Http\Resources\TeacherLoginResource;
use App\Services\ITeacherServices;

class TeacherAuthController extends Controller
{
    public function login(TeacherLoginRequest $request, ITeacherServices $teacherService)
    {
        $result = $teacherService->loginTeacher($request->getDto());

        if (!$result['success']) {
            return response()->json(['message' => $result['message']], 401);
        }

        return TeacherLoginResource::make($result);
    }
}
