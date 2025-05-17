<?php

namespace App\Services;

use App\Dto\LoginDto;
use App\Dto\SaveTeacherDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IAdminServices
{
    public function login(LoginDto $dto): array;
}
