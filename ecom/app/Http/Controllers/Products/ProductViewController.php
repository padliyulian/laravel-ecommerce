<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Models\ProductAttributeValue;

class ProductViewController extends Controller
{
	private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
	
    public function show($slug)
	{
		$product = $this->productService->detail($slug);
		$this->data['product'] = $product;

		if ($product->configurable()) {
			$this->data['colors'] = ProductAttributeValue::getAttributeOptions($product, 'color')
                ->pluck('text_value', 'text_value');
			$this->data['sizes'] = ProductAttributeValue::getAttributeOptions($product, 'size')
                ->pluck('text_value', 'text_value');
		}
		
		return $this->load_theme('products.quick_view', $this->data);
	}
}