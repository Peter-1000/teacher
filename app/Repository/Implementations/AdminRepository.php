<?php

namespace App\Repository\Implementations;

use App\Models\Admin;
use App\Repository\IAdminRepository;
use Illuminate\Database\Eloquent\Model;

class AdminRepository implements IAdminRepository
{
    public function findByEmail(string $email): ?Model
    {
        return Admin::query()->where('email', $email)->firstOrFail();
    }
}
