<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Models\Category;

class CategoryRepository
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
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

        $query = $this->category->with('parent')->orderBy($column, $dir);

        if ($search) {
            $query->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
                    // ->orWhere('title', 'like', '%' . $search . '%');
            });
        }

        $data = $query->paginate($length);
        return $data;
    }

    public function add($request)
    {
        $category = new $this->category;
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->parent_id = $request->parent_id;
        $category->created_by = auth()->user()->id;
        $category->save();
        return $category;
    }

    public function detail($id)
    {
        return $this->category::findOrFail($id);
    }

    public function update($request, $id)
    {
        $category = $this->category::findOrFail($id);
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->slug = Str::slug($request->name);
        $category->updated_by = auth()->user()->id;
        $category->update();
        return $category;
    }

    public function delete($id)
    {
        $category = $this->category::findOrFail($id);
        $category->delete();
        return $category;
    }

    public function listOf()
    {
        $categories = $this->category::orderBy('name', 'asc')->get();
        return $categories->toArray();
    }
}
