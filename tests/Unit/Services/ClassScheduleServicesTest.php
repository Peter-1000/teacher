<?php

namespace Services;

use App\Dto\SaveClassScheduleDto;
use App\Models\ClassSchedule;
use App\Services\implementations\ClassScheduleService;
use Illuminate\Pagination\LengthAwarePaginator;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Stubs\ClassScheduleRepositoryStub;

class ClassScheduleServicesTest extends TestCase
{
    public function createClassScheduleServicesObj(): ClassScheduleService
    {
        return new ClassScheduleService(new ClassScheduleRepositoryStub());
    }

    public function testGetAll()
    {
        $services = $this->createClassScheduleServicesObj();
        $paginator = $services->getAll();
        $this->assertInstanceOf(LengthAwarePaginator::class, $paginator);
    }

    public function testFind()
    {
        $services = $this->createClassScheduleServicesObj();
        $classesSchedule = $services->find(1);
        $this->assertInstanceOf(ClassSchedule::class, $classesSchedule);
    }

    public function testNotFound()
    {
        $services = $this->createClassScheduleServicesObj();
        $classesSchedule = $services->find(4);
        $this->assertNull($classesSchedule);
    }

    public function testSuccessGetByTeacherId()
    {
        $services = $this->createClassScheduleServicesObj();
        $classesSchedule = $services->getByTeacherId(1);
        $this->assertEquals(2, $classesSchedule->count());
    }

    public function testZeroGetByTeacherId()
    {
        $services = $this->createClassScheduleServicesObj();
        $classesSchedule = $services->getByTeacherId(3);
        $this->assertEquals(0, $classesSchedule->count());
    }

    public function testSuccessGetBySubjectId()
    {
        $services = $this->createClassScheduleServicesObj();
        $classesSchedule = $services->getBySubjectId(1);
        $this->assertEquals(2, $classesSchedule->count());
    }

    public function testZeroGetBySubjectId()
    {
        $services = $this->createClassScheduleServicesObj();
        $classesSchedule = $services->getBySubjectId(3);
        $this->assertEquals(0, $classesSchedule->count());
    }

    public function testCreate()
    {
        $dto = new SaveClassScheduleDto();
        $dto->setTeacherId(5);
        $dto->setSubjectId(5);
        $dto->setStartedAt(now());
        $dto->setEndedAt(now()->addMinutes(30));
        $services = $this->createClassScheduleServicesObj();
        $classesSchedule = $services->create($dto);
        $this->assertInstanceOf(ClassSchedule::class, $classesSchedule);
    }

    public function testUpdate()
    {
        $dto = new SaveClassScheduleDto();
        $dto->setTeacherId(5);
        $dto->setSubjectId(5);
        $dto->setStartedAt(now());
        $dto->setEndedAt(now()->addMinutes(30));
        $services = $this->createClassScheduleServicesObj();
        $classesSchedule = $services->update(1, $dto);
        $this->assertInstanceOf(ClassSchedule::class, $classesSchedule);
    }
}
