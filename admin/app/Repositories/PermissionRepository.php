<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository
{
    private $permission;

    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }

    public function list()
    {
        return $this->permission->all();
    }
}