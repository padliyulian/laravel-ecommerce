<?php

namespace App\Repositories;

use App\Models\Attribute;
use App\Models\AttributeOption;

class AttributeRepository
{
    private $attribute;

    public function __construct(Attribute $attribute)
    {
        $this->attribute = $attribute;
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

        $query = $this->attribute->orderBy($column, $dir);

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
        $attribute = new $this->attribute;
        $attribute->code = $request->code;
        $attribute->name = $request->name;
        $attribute->type = $request->type;

        if ($request->has('is_required')) {
            $attribute->is_required = $request->is_required;
        }
        if ($request->has('is_unique')) {
            $attribute->is_unique = $request->is_unique;
        }
        if ($request->has('is_filterable')) {
            $attribute->is_filterable = $request->is_filterable;
        }
        if ($request->has('validation')) {
            $attribute->validation = $request->validation;
        }
        if ($request->has('is_required')) {
            $attribute->is_required = $request->is_required;
        }
        if ($request->has('is_configurable')) {
            $attribute->is_configurable = $request->is_configurable;
        }

        $attribute->created_by = auth()->user()->id;
        $attribute->save();
        return $attribute;
    }

    public function update($request, $id)
    {
        $attribute = $this->attribute->findOrFail($id);
        $attribute->code = $request->code;
        $attribute->name = $request->name;
        $attribute->type = $request->type;

        if ($request->has('is_required')) {
            $attribute->is_required = $request->is_required;
        }
        if ($request->has('is_unique')) {
            $attribute->is_unique = $request->is_unique;
        }
        if ($request->has('is_filterable')) {
            $attribute->is_filterable = $request->is_filterable;
        }
        if ($request->has('validation')) {
            $attribute->validation = $request->validation;
        }
        if ($request->has('is_required')) {
            $attribute->is_required = $request->is_required;
        }
        if ($request->has('is_configurable')) {
            $attribute->is_configurable = $request->is_configurable;
        }

        $attribute->updated_by = auth()->user()->id;
        $attribute->save();
        return $attribute;
    }

    public function delete($id)
    {
        $attribute = $this->attribute->findOrFail($id);
        $attribute->delete();
        return $attribute;
    }

    public function detail($id)
    {
        return $this->attribute->findOrFail($id);
    }

    public function optionAdd($request, $id)
    {
        $attribute_option = new AttributeOption;
        $attribute_option->attribute_id = $id;
        $attribute_option->name = $request->name;
        $attribute_option->save();
        return $attribute_option;
    }

    public function optionUpdate($request, $id)
    {
        $attribute_option = AttributeOption::findOrFail($id);
        // $attribute_option->attribute_id = $request->id;
        $attribute_option->name = $request->name;
        $attribute_option->update();
        return $attribute_option;
    }

    public function optionDetail($id)
    {
        return AttributeOption::findOrFail($id);
    }

    public function optionDelete($id)
    {
        $attribute_option = AttributeOption::findOrFail($id);
        $attribute_option->delete();
        return $attribute_option;
    }

    public function types()
    {
        return $this->attribute::types();
    }

    public function booleanOptions()
    {
        return $this->attribute::booleanOptions();
    }

    public function validations()
    {
        return $this->attribute::validations();
    }
}
