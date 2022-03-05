<?php

namespace App\Repositories\Interfaces;

use App\Repositories\BaseContract;

interface UserRepositoryInterface extends BaseContract
{
    public function searchUser($key);
    public function getAllRole();
    public function insertRole($userId, $role);
    public function getAllPermission();
    public function insertPermission($userId, array $permission);
}
