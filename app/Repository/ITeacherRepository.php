<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ITeacherRepository
{
    public function create(array $data): Model;

    public function find(int $id): ?Model;

    public function findByEmail(string $email): ?Model;

    public function update(int $id, array $data): Model;

    public function delete(int $id): void;

    public function getAll(): LengthAwarePaginator;
}
