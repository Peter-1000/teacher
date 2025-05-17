<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AdminLoginRequest;
use App\Http\Resources\AdminLoginResource;
use App\Services\IAdminServices;

class AdminAuthController extends Controller
{
    public function login(AdminLoginRequest $request, IAdminServices $adminServices)
    {
        $result = $adminServices->login($request->getDto());

        if (!$result['success']) {
            return response()->json(['message' => $result['message']], 401);
        }

        return AdminLoginResource::make($result);
    }
}
