<?php

namespace App\Repository\Implementations;

use App\Models\ClassSchedule;
use App\Repository\IClassScheduleRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class ClassScheduleRepository implements IClassScheduleRepository
{

    public function create(array $data): Model
    {
        return ClassSchedule::query()->create($data);
    }

    public function find(int $id, $teacherId = null): ?Model
    {
        return ClassSchedule::query()
            ->with(['teacher', 'subject'])
            ->when($teacherId, fn($q) => $q->where('teacher_id', $teacherId))
            ->findOrFail($id);
    }

    public function update(int $id, array $data): Model
    {
        $classSchedule = $this->find($id);
        $classSchedule->update($data);
        return $classSchedule;
    }

    public function delete(int $id, $teacherId = null): void
    {
        $classSchedule = $this->find($id, $teacherId);
        $classSchedule->delete();
    }

    public function getAll($teacherId = null): LengthAwarePaginator
    {
        return ClassSchedule::query()
            ->with(['teacher', 'subject'])
            ->when($teacherId, fn($q) => $q->where('teacher_id', $teacherId))
            ->paginate();
    }

    public function getByTeacherId(int $teacherId): Collection
    {
        return ClassSchedule::query()->with(['teacher', 'subject'])->where('teacher_id', $teacherId)->get();
    }

    public function getBySubjectId(int $subjectId): Collection
    {
        return ClassSchedule::query()->with(['teacher', 'subject'])->where('subject_id', $subjectId)->get();
    }

    public function checkConflict(int $teacherId, string $started_at, string $ended_at, $classScheduleId = null): bool
    {
        return ClassSchedule::query()
            ->where('teacher_id', $teacherId)
            ->when($classScheduleId, fn($q) => $q->where('id', '!=', $classScheduleId)) // for update
            ->where(function ($query) use ($started_at, $ended_at) {
                $query->whereBetween('start_time', [$started_at, $ended_at])
                    ->orWhereBetween('end_time', [$started_at, $ended_at])
                    ->orWhere(function ($query) use ($started_at, $ended_at) {
                        $query->where('start_time', '<', $started_at)
                            ->where('end_time', '>', $ended_at);
                    });
            })
            ->exists();
    }
}
