<?php 

namespace App\Services;

use App\Models\Employee;
use App\Repositories\EmployeeRepository;

class EmployeeService
{
    protected $repository;

    public function __construct(EmployeeRepository $employee)
    {
        $this->repository = $employee;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function update(array $data, string $id)
    {
        return $this->repository->update($data, $id);
    }

    public function updateStatus(string $id)
    {
        return $this->repository->updateStatus($id);
    }
}