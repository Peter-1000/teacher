<?php

namespace App\Services\implementations;

use App\Dto\SaveClassScheduleDto;
use App\Exceptions\SchedulingConflictException;
use App\Repository\IClassScheduleRepository;
use App\Services\IClassScheduleServices;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ClassScheduleService implements IClassScheduleServices
{
    protected IClassScheduleRepository $classScheduleRepository;

    public function __construct(IClassScheduleRepository $classScheduleRepository)
    {
        $this->classScheduleRepository = $classScheduleRepository;
    }

    public function getAll($teacherId = null): LengthAwarePaginator
    {
        return $this->classScheduleRepository->getAll($teacherId);
    }

    public function create(SaveClassScheduleDto $dto): Model
    {
        $checkConflict = $this->classScheduleRepository->checkConflict($dto->getTeacherId(), $dto->getStartedAt(), $dto->getEndedAt());
        if ($checkConflict) {
            throw new SchedulingConflictException();
        }
        return $this->classScheduleRepository->create($dto->toArray());
    }

    public function update(int $id, SaveClassScheduleDto $dto): Model
    {
        $classSchedule = $this->find($id);
        $checkConflict = $this->classScheduleRepository->checkConflict($dto->getTeacherId(), $dto->getStartedAt(), $dto->getEndedAt(), $classSchedule->id);
        if ($checkConflict) {
            throw new SchedulingConflictException();
        }

        return $this->classScheduleRepository->update($id, $dto->toArray());
    }

    public function delete(int $id, $teacherId = null): void
    {
        $this->classScheduleRepository->delete($id, $teacherId);
    }

    public function find(int $id, $teacherId = null): ?Model
    {
        return $this->classScheduleRepository->find($id, $teacherId);
    }

    public function getByTeacherId(int $teacherId): Collection
    {
        return $this->classScheduleRepository->getByTeacherId($teacherId) ?? new Collection();
    }

    public function getBySubjectId(int $subjectId): Collection
    {
        return $this->classScheduleRepository->getBySubjectId($subjectId);
    }
}
