<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IClassScheduleRepository
{
    public function create(array $data): Model;

    public function find(int $id, $teacherId = null): ?Model;

    public function update(int $id, array $data): Model;

    public function delete(int $id, $teacherId = null): void;

    public function getAll($teacherId = null): LengthAwarePaginator;

    public function getByTeacherId(int $teacherId): Collection;

    public function getBySubjectId(int $subjectId): Collection;

    public function checkConflict(int $teacherId, string $started_at, string $ended_at, $classScheduleId = null): bool;
}
