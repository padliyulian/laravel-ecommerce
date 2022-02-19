<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Attribute;
use App\Http\Requests\AttributeRequest;
use App\Repositories\AttributeRepository;

class AttributeController extends Controller
{
    private $attributeRepository;

    public function __construct(AttributeRepository $attributeRepository)
    {
        $this->data['currentAdminSubMenu1'] = 'products';
        $this->data['currentAdminSubMenu2'] = '';
        $this->data['currentAdminMenu'] = 'attribute';

        $this->attributeRepository = $attributeRepository;
        $this->data['types'] = $this->attributeRepository->types();
        $this->data['booleanOptions'] = $this->attributeRepository->booleanOptions();
        $this->data['validations'] = $this->attributeRepository->validations();
    }

    public function index(Request $request)
    {
        $this->data['attributes'] = $this->attributeRepository->list($request);
        return view('pages.product.attribute.index', $this->data);
    }

    public function create()
    {
        $this->data['attribute'] = null;
        return view('pages.product.attribute.create', $this->data);
    }

    public function store(AttributeRequest $request)
    {
        $data = $this->attributeRepository->add($request);
        
        if ($data) {
            session()->flash('success.message', 'Attribute has been saved');
        }

        return redirect('/product/attribute');
    }

    public function edit($id)
    {
        $this->data['attribute'] = $this->attributeRepository->detail($id);
        return view('pages.product.attribute.edit', $this->data);
    }

    public function update(AttributeRequest $request, $id)
    {
        $data = $this->attributeRepository->update($request, $id);
        
        if ($data) {
            session()->flash('success.message', 'Attribute has been updated');
        }

        return redirect('/product/attribute');
    }

    public function destroy($id)
    {
        $data = $this->attributeRepository->delete($id);
        
        if ($data) {
            session()->flash('success.message', 'Attribute has been deleted');
        }

        return redirect('/product/attribute');
    }
}