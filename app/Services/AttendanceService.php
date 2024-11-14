<?php 

namespace App\Services;

use App\Repositories\AttendanceRepository;

class AttendanceService
{
    protected $repository;

    public function __construct(AttendanceRepository $attendance)
    {
        $this->repository = $attendance;
    }

    public function getEmployeeClockedIn()
    {
        return $this->repository->getEmployeeClockedIn();
    }

    public function clockIn(array $data)
    {
        return $this->repository->clockIn($data);
    }

    public function clockOut(string $id)
    {
        return $this->repository->clockOut($id);
    }

    public function getEmployeeAttendance()
    {
        return $this->repository->getEmployeeAttendance();
    }

    public function updateMyAttendance(array $data, string $id)
    {
        return $this->repository->updateMyAttendance($data, $id);
    }
}