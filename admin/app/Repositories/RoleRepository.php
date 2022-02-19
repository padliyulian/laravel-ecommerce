<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\Permission;

class RoleRepository
{
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function list()
    {
        return $this->role->with('permissions')->get();
    }

    public function add($request)
    {
        $role = new $this->role;
        $role->name = $request->name;
        $role->save();
        return $role;
    }

    public function update($request, $id)
    {
        $role = $this->role->findOrFail($id);

        if ($role->name == 'Admin') {
            $role->syncPermissions(Permission::all());
        } else {
            $role->syncPermissions($request->permissions);
        }
        
        return $role;
    }
}