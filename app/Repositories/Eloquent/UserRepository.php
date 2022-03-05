<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

     /**
     * list user search function
     *
     * @return Object | Exception
     */
    public function searchUser($key)
    {
        $data = $this->user->getModel()->where('name', 'LIKE', '%' . $key . '%')
            ->orWhere('email', 'LIKE', '%' . $key . '%')
            ->paginate();

        return $data;
    }

     /**
     * list role function
     *
     * @return Object | Exception
     */
    public function getAllRole()
    {
        return Role::all();
    }

    /**
     * insert role function
     *
     */
    public function insertRole($user, $role)
    {
        $user->syncRoles($role);
    }

    /**
     * list permission function
     *
     * @return Object | Exception
     */
    public function getAllPermission()
    {
        return Permission::all();
    }
    
    /**
     * insert permission function
     *
     */
    public function insertPermission($roleId, array $permission)
    {
        $role = Role::find($roleId);
        $role->syncPermissions($permission);
    }
}
