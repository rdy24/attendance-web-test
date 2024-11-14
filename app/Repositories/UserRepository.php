<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new User();
    }

    public function getAll()
    {
        return $this->model->orderBy('created_at', 'desc')->get();
    }

    public function update(array $data, string $id)
    {
        try {
            DB::beginTransaction();

            $user = $this->model->find($id);

            $user->update([
                'email' => $data['email'],
            ]);

            if (isset($data['password'])) {
                $user->update([
                    'password' => bcrypt($data['password']),
                ]);
            }

            DB::commit();

            return $user;

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function updateStatus(string $id)
    {
        try {
            DB::beginTransaction();

            $user = $this->model->find($id);

            $user->employee->update([
                'status' => $user->status === 'active' ? 'inactive' : 'active',
            ]);

            $user->update([
                'status' => $user->status === 'active' ? 'inactive' : 'active',
            ]);

            DB::commit();

            return $user;

        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
}