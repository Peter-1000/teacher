<?php

namespace App\Dto;

class SaveClassScheduleDto
{
    private int $teacherId;
    private int $subjectId;
    private string $start_time;
    private string $end_time;

    public function getTeacherId(): int
    {
        return $this->teacherId;
    }

    public function setTeacherId(int $teacherId): self
    {
        $this->teacherId = $teacherId;
        return $this;
    }

    public function getSubjectId(): int
    {
        return $this->subjectId;
    }

    public function setSubjectId(int $subjectId): self
    {
        $this->subjectId = $subjectId;
        return $this;
    }

    public function getStartedAt(): string
    {
        return $this->start_time;
    }

    public function setStartedAt(string $start_time): self
    {
        $this->start_time = $start_time;
        return $this;
    }

    public function getEndedAt(): string
    {
        return $this->end_time;
    }

    public function setEndedAt(string $end_time): self
    {
        $this->end_time = $end_time;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'teacher_id'  => $this->getTeacherId(),
            'subject_id'  => $this->getSubjectId(),
            'start_time'  => $this->getStartedAt(),
            'end_time'    => $this->getEndedAt(),
        ];
    }
}
