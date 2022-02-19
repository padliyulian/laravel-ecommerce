<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Repositories\AttributeRepository;
use App\Http\Requests\AttributeOptionRequest;

class AttributeOptionController extends Controller
{
    private $attributeRepository;

    public function __construct(AttributeRepository $attributeRepository)
    {
        $this->data['currentAdminSubMenu1'] = 'products';
        $this->data['currentAdminSubMenu2'] = '';
        $this->data['currentAdminMenu'] = 'attribute';

        $this->attributeRepository = $attributeRepository;
    }
    
    public function index($id)
    {
        if (empty($id)) {
            return redirect('/product/attribute');
        }

        $this->data['attribute'] = $this->attributeRepository->detail($id);

        return view('pages.product.attribute.option.index', $this->data);
    }

    public function store(AttributeOptionRequest $request, $id)
    {
        if (empty($id)) {
            return redirect('/product/attribute');
        }

        $this->data['status'] = $this->attributeRepository->optionAdd($request, $id);

        if ($this->data['status']) {
            session()->flash('success.message', 'option has been saved');
        }

        return redirect('/product/attribute/option/'.$id);
    }

    public function edit($id)
    {
        $option = $this->attributeRepository->optionDetail($id);

        $this->data['attributeOption'] = $option;
        $this->data['attribute'] = $option->attribute;

        return view('pages.product.attribute.option.index', $this->data);
    }

    public function update(AttributeOptionRequest $request, $id)
    {
        $option = $this->attributeRepository->optionUpdate($request, $id);

        if ($option) {
            session()->flash('success.message', 'Option has been updated');
        }

        return redirect('/product/attribute/option/'.$option->attribute_id);
    }

    public function destroy($id)
    {
        $data = $this->attributeRepository->optionDelete($id);
        
        if ($data) {
            session()->flash('success.message', 'Attribute option has been deleted');
        }

        return redirect()->back();
    }
}