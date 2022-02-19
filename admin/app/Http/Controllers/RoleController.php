<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;

class RoleController extends Controller
{
    private $roleRepository;
    private $permissionRepository;

    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        parent::__construct();

        $this->data['currentAdminSubMenu1'] = 'settings';
        $this->data['currentAdminSubMenu2'] = 'users';
        $this->data['currentAdminMenu'] = 'role';

        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        $this->data['roles'] = $this->roleRepository->list();
        $this->data['permissions'] = $this->permissionRepository->list();

        return view('pages.role.index', $this->data);
    }

    public function store(RoleRequest $request)
    {
        $role = $this->roleRepository->add($request);
        if ($role) {
            session()->flash('success.message', 'New role added.');
            return redirect('/role');
        }
    }

    public function update(Request $request, $id)
    {
        $role = $this->roleRepository->update($request, $id);
        session()->flash('success.message', $role->name . ' permissions has been updated.');
        return redirect()->back();
    }
}
