<?php

namespace App\Services;

use App\Dto\LoginDto;
use App\Dto\SaveTeacherDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface ITeacherServices
{
    public function getAll(): LengthAwarePaginator;

    public function create(SaveTeacherDto $dto): Model;

    public function update(int $id, SaveTeacherDto $dto): Model;

    public function delete(int $id): void;

    public function find(int $id): ?Model;

    public function findByEmail(string $email): ?Model;

    public function loginTeacher(LoginDto $dto): array;
}
