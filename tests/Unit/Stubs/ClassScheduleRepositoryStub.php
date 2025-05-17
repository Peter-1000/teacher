<?php

namespace Tests\Unit\Stubs;

use App\Models\ClassSchedule;
use App\Repository\IClassScheduleRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\TestCase;

class ClassScheduleRepositoryStub extends TestCase implements IClassScheduleRepository
{
    private array $classSchedule = [];
    private array $teacherClassSchedule = [];
    private array $subjectsClassSchedule = [];

    public function __construct()
    {
        $classSchedule1 = new ClassSchedule();
        $classSchedule1->teacher_id = 1;
        $classSchedule2 = new ClassSchedule();
        $classSchedule2->teacher_id = 2;
        $classSchedule3 = new ClassSchedule();
        $classSchedule3->teacher_id = 3;

        $this->classSchedule[1] = $classSchedule1;
        $this->classSchedule[2] = $classSchedule2;
        $this->classSchedule[3] = $classSchedule3;

        $this->teacherClassSchedule[1] = [$classSchedule1, $classSchedule2];
        $this->teacherClassSchedule[2] = [$classSchedule3];

        $this->subjectsClassSchedule[1] = [$classSchedule1, $classSchedule2];
        $this->subjectsClassSchedule[2] = [$classSchedule3];
    }

    public function create(array $data): Model
    {
        $newClassSchedule = new ClassSchedule();
        $newClassSchedule->subject_id = $data['subject_id'];
        $this->classSchedule[count($this->classSchedule) - 1] = $newClassSchedule;
        return $newClassSchedule;
    }

    public function find(int $id, $teacherId = null): ?Model
    {
        return $this->classSchedule[$id] ?? null;
    }

    public function update(int $id, array $data): Model
    {
        $schedule = $this->classSchedule[$id];
        $schedule->subject_id = $data['subject_id'];
        return $schedule;
    }

    public function delete(int $id, $teacherId = null): void
    {
        unset($this->classSchedule[$id]);
    }

    public function getAll($teacherId = null): LengthAwarePaginator
    {
        return $this->createStub(LengthAwarePaginator::class);
    }

    public function getByTeacherId(int $teacherId): Collection
    {
        return new Collection($this->teacherClassSchedule[$teacherId] ?? new Collection());
    }

    public function getBySubjectId(int $subjectId): Collection
    {
        return new Collection($this->subjectsClassSchedule[$subjectId] ?? new Collection());
    }

    public function checkConflict(int $teacherId, string $started_at, string $ended_at, $classScheduleId = null): bool
    {
        return false;
    }
}
