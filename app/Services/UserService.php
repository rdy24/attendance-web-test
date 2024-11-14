<?php 

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $repository;

    public function __construct(UserRepository $user)
    {
        $this->repository = $user;
    }

    public function getAll()
    {
        return $this->repository->getAll();
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