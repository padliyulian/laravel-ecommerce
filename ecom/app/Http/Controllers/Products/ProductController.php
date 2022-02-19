<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AttributeOption;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Models\ProductAttributeValue;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $this->data = $this->productService->list($request, 9);
        return $this->load_theme('products.index', $this->data);
    }

    public function show($slug)
    {
        $product = $this->productService->detail($slug);

        if (!$product) {
            return redirect('/product');
        }

        if ($product->type == 'configurable') {
            $this->data['colors'] = $this->productService->getAttributeValue($product, 'color');
            $this->data['sizes'] = $this->productService->getAttributeValue($product, 'size');
        }

        $this->data['product'] = $product;

        return $this->load_theme('products.show', $this->data);
    }
}
