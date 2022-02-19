<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function list($request)
    {
        if ($request->has('length')) {
            $length = $request->input('length');
        } else {
            $length = 10;
        }

        if ($request->has('column')) {
            $column = $request->input('column');
        } else {
            $column = 'id';
        }

        if ($request->has('dir')) {
            $dir = $request->input('dir');
        } else {
            $dir = 'desc';
        }

        if ($request->has('search')) {
            $search = $request->input('search');
        } else {
            $search = '';
        }

        $query = $this->user->with('roles')->orderBy($column, $dir);

        if ($search) {
            $query->where(function($query) use ($search) {
                $query->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%');
            });
        }

        $data = $query->paginate($length);
        return $data;
    }

    public function add($request)
    {
        $user = DB::transaction(function() use ($request) {
            $user = new $this->user;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            
            if ($user->save()) {
                $user->assignRole($request->role);
                return $user;
            }
        });

        return $user;
    }

    public function detail($id)
    {
        return $this->user->with('roles')->findOrFail($id);
    }

    public function update($request, $id)
    {
        $user = DB::transaction(function() use ($request, $id) {
            $user = $this->user->findOrFail($id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->password = bcrypt($request->password);
            $user->email = $request->email;
            
            if ($user->update()) {
                $user->syncRoles($request->role);
                return $user;
            }
        });

        return $user;
    }

    public function delete($id)
    {
        $user = $this->user->findOrFail($id);
        $user->delete();
        return $user;
    }
}