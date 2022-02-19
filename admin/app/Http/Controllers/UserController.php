<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    private $userRepository;
    private $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        parent::__construct();

        $this->data['currentAdminSubMenu1'] = 'settings';
        $this->data['currentAdminSubMenu2'] = 'users';
        $this->data['currentAdminMenu'] = 'user';

        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index(Request $request)
    {
        $this->data['users'] = $this->userRepository->list($request);
        return view('pages.user.index', $this->data);
    }

    public function create()
    {
        $this->data['roles'] = $this->roleRepository->list();
        return view('pages.user.create', $this->data);
    }

    public function store(UserRequest $request)
    {
        $user = $this->userRepository->add($request);

        if ($user) {
            session()->flash('success.message', 'User has been created');
            return redirect('/user');
        }
    }

    public function edit($id)
    {
        $this->data['user'] = $this->userRepository->detail($id);
        $this->data['roles'] = $this->roleRepository->list();

        return view('pages.user.edit', $this->data);
    }

    public function update(UserRequest $request, $id)
    {
        $user = $this->userRepository->update($request, $id);

        if ($user) {
            session()->flash('success.message', 'User has been updated');
            return redirect('/user');
        }
    }

    public function destroy($id)
    {
        $user = $this->userRepository->delete($id);

        if ($user) {
            session()->flash('success.message', 'User has been deleted');
            return redirect('/user');
        }
    }

}
