<?php

namespace App\Services\implementations;

use App\Dto\LoginDto;
use App\Dto\SaveTeacherDto;
use App\Repository\ITeacherRepository;
use App\Services\ITeacherServices;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class TeacherService implements ITeacherServices
{
    protected ITeacherRepository $teacherRepository;

    public function __construct(ITeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function getAll(): LengthAwarePaginator
    {
        return $this->teacherRepository->getAll();
    }

    public function create(SaveTeacherDto $dto): Model
    {
        return $this->teacherRepository->create($dto->toArray());
    }

    public function update(int $id, SaveTeacherDto $dto): Model
    {
        return $this->teacherRepository->update($id, $dto->toArray());
    }

    public function delete(int $id): void
    {
        $this->teacherRepository->delete($id);
    }

    public function find(int $id): ?Model
    {
        return $this->teacherRepository->find($id);
    }

    public function findByEmail(string $email): ?Model
    {
        return $this->teacherRepository->findByEmail($email);
    }

    public function loginTeacher(LoginDto $dto): array
    {
        $teacher = $this->teacherRepository->findByEmail($dto->getEmail());

        if (!$teacher || !Hash::check($dto->getPassword(), $teacher->password)) {
            return [
                'success' => false,
                'message' => 'Invalid credentials',
                'token' => null,
            ];
        }

        $token = $teacher->createToken('teacher-token', ['teacher'])->plainTextToken;

        return [
            'success' => true,
            'message' => 'Login successful',
            'teacher' => $teacher,
            'token' => $token,
        ];
    }
}
