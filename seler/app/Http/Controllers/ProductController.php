<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;
use App\Repositories\CategoryRepository;

// use App\Authorizable;

class ProductController extends Controller
{
    // use Authorizable;

    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->data['currentAdminSubMenu1'] = 'products';
        $this->data['currentAdminSubMenu2'] = '';
        $this->data['currentAdminMenu'] = 'product';

        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $this->data['products'] = $this->productRepository->list($request);
        return view('pages.product.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(CategoryRepository $categoryRepository)
    {
        $this->data['statuses'] = $this->productRepository->listOfStatus();
		$this->data['types'] = $this->productRepository->listOfType();
		$this->data['categories'] = $categoryRepository->listOf();
		$this->data['product'] = null;
		$this->data['productID'] = 0;
		$this->data['categoryIDs'] = [];
		$this->data['configurableAttributes'] = $this->productRepository->getConfigurableAttributes();

        return view('pages.product.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ProductRequest $request)
    {
        // return $request;
        $data = $this->productRepository->add($request);

        if ($data) {
            session()->flash('success.message', 'Success adding data');
            return redirect('/product');
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit(CategoryRepository $categoryRepository, $id)
    {
        $product = $this->productRepository->detail($id);

        $this->data['statuses'] = $this->productRepository->listOfStatus();
		$this->data['types'] = $this->productRepository->listOfType();
        $this->data['categories'] = $categoryRepository->listOf();
        $this->data['product'] = $product;
        $this->data['categoryIDs'] = $product->categories->pluck('id')->toArray();

        return view('pages.product.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ProductRequest $request, $id)
    {
        // return $request;
        $data = $this->productRepository->update($request, $id);

        if ($data) {
            session()->flash('success.message', 'Success updating data');
            return redirect('/product');
        } else {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $data = $this->productRepository->delete($id);
        if ($data) {
            session()->flash('success.message', 'Success deleting data');
            return redirect('/product');
        } else {
            return abort(404);
        }
    }
}
