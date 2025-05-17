<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IAdminRepository
{
    public function findByEmail(string $email): ?Model;
}
