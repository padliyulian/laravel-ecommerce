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
use App\Http\Requests\ProductImageRequest;

class ProductImageController extends Controller
{
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
    public function index($id)
    {
        $product = $this->productRepository->detail($id);

        $this->data['product'] = $product;
        $this->data['productImages'] = $product->productImages;

        return view('pages.product.image.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($id)
    {
        $product = $this->productRepository->detail($id);
        $this->data['product'] = $product;

        return view('pages.product.image.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ProductImageRequest $request, $id)
    {
        if ($request->hasFile('image')) {
            $data = $this->productRepository->addImage($request, $id);

            if ($data) {
                session()->flash('success.message', 'Image has been uploaded');
            } else {
                session()->flash('error.message', 'Image could not be uploaded');
            }

            return redirect('/product/image/'.$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $image = $this->productRepository->deleteImage($id);

        if ($image) {
            session()->flash('success.message', 'Image has been deleted');
        }

        return redirect('/product/image/'.$image->product->id);
    }
}
