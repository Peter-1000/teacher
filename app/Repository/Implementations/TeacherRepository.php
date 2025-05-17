<?php

namespace App\Repository\Implementations;

use App\Models\Teacher;
use App\Repository\ITeacherRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class TeacherRepository implements ITeacherRepository
{
    public function create(array $data): Model
    {
        return Teacher::query()->create($data);
    }

    public function find(int $id): ?Model
    {
        return Teacher::query()->findOrFail($id);
    }

    public function findByEmail(string $email): ?Model
    {
        return Teacher::query()->where('email', $email)->firstOrFail();
    }

    public function update(int $id, array $data): Model
    {
        $Teacher = $this->find($id);
        $Teacher->update($data);
        return $Teacher;
    }

    public function delete(int $id): void
    {
        $Teacher = $this->find($id);
        $Teacher->delete();
    }

    public function getAll(): LengthAwarePaginator
    {
        return Teacher::query()->paginate();
    }
}
