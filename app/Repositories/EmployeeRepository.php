<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class EmployeeRepository
{
    protected $model;
    protected $userModel;

    public function __construct()
    {
        $this->model = new Employee();
        $this->userModel = new User();
    }

    public function getAll()
    {
        return $this->model->with('user')->orderBy('created_at', 'desc')->get();
    }

    public function store(array $data)
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);

            $user->assignRole($data['role']);

            $employee = $this->model->create([
                'user_id' => $user->id,
                'date_of_birth' => $data['date_of_birth'],
                'city' => $data['city'],
                'status' => $data['status'],
            ]);

            DB::commit();

            return $employee;

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function update(array $data, string $id)
    {
        try {
            DB::beginTransaction();

            $employee = $this->model->find($id);

            $employee->user->syncRoles([$data['role']]);

            $employee->update([
                'date_of_birth' => $data['date_of_birth'],
                'city' => $data['city'],
            ]);

            $employee->user->update([
                'name' => $data['name'],
            ]);

            DB::commit();

            return $employee;

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function updateStatus(string $id)
    {
        try {
            DB::beginTransaction();

            $employee = $this->model->find($id);

            $employee->user->update([
                'status' => $employee->status === 'active' ? 'inactive' : 'active',
            ]);

            $employee->update([
                'status' => $employee->status === 'active' ? 'inactive' : 'active',
            ]);

            DB::commit();

            return $employee;

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}