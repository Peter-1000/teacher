<?php

namespace App\Services;

use App\Dto\SaveClassScheduleDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface IClassScheduleServices
{
    public function getAll($teacherId = null): LengthAwarePaginator;

    public function create(SaveClassScheduleDto $dto): Model;

    public function update(int $id, SaveClassScheduleDto $dto): Model;

    public function delete(int $id, $teacherId = null): void;

    public function find(int $id, $teacherId = null): ?Model;

    public function getByTeacherId(int $teacherId): Collection;

    public function getBySubjectId(int $subjectId): Collection;

}
