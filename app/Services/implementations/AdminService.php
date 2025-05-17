<?php

namespace App\Services\implementations;

use App\Dto\LoginDto;
use App\Dto\SaveTeacherDto;
use App\Repository\IAdminRepository;
use App\Repository\ITeacherRepository;
use App\Services\IAdminServices;
use App\Services\ITeacherServices;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class AdminService implements IAdminServices
{
    protected IAdminRepository $adminRepository;

    public function __construct(IAdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function login(LoginDto $dto): array
    {
        $admin = $this->adminRepository->findByEmail($dto->getEmail());

        if (!$admin || !Hash::check($dto->getPassword(), $admin->password)) {
            return [
                'success' => false,
                'message' => 'Invalid credentials',
                'token' => null,
            ];
        }

        $token = $admin->createToken('admin-token', ['admin'])->plainTextToken;

        return [
            'success' => true,
            'message' => 'Login successful',
            'teacher' => $admin,
            'token' => $token,
        ];
    }
}
