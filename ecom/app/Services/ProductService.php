<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\AttributeOption;
use App\Models\ProductAttributeValue;

class ProductService
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function list($request, $page)
    {
        $this->data['keyword'] = null;
        $this->data['categories'] = $this->_getParentCategories();
        
        $this->data['minPrice'] = $this->_price('min');
        $this->data['maxPrice'] = $this->_price('max');

        $this->data['colors'] = $this->_getAttributeOption('color');
        $this->data['sizes'] = $this->_getAttributeOption('size');
                                
        $this->data['sorts'] = $this->_getSortOption();
        $this->data['selectedSort'] = url('product');

        $products = $this->product->active()->with('variants','productImages');
        $products = $this->_searchProducts($products, $request);
        $products = $this->_filterProductsByPriceRange($products, $request);
        $products = $this->_filterProductsByAttribute($products, $request);
        $products = $this->_sortProducts($products, $request);

        $this->data['products'] = $products->paginate($page);
        return $this->data;
    }

    public function detail($slug)
    {
        return $this->product->active()->where('slug', $slug)->firstOrFail();
    }


    public function _searchProducts($products, $request)
    {
        if ($keyword = $request->query('keyword')) {
            $keyword = str_replace('-', ' ', Str::slug($keyword));
            
            $products = $products->whereRaw('MATCH(name, slug, short_description, description) AGAINST (? IN NATURAL LANGUAGE MODE)', [$keyword]);

            $this->data['keyword'] = $keyword;
        }

        if ($categorySlug = $request->query('category')) {
            $category = Category::where('slug', $categorySlug)->firstOrFail();

            $childIds = Category::childIds($category->id);
            $categoryIds = array_merge([$category->id], $childIds);

            $products = $products->whereHas('categories', function ($query) use ($categoryIds) {
                $query->whereIn('categories.id', $categoryIds);
            });
        }

        return $products;
    }

    public function _filterProductsByPriceRange($products, $request)
    {
        $lowPrice = null;
        $highPrice = null;

        if ($priceSlider = $request->query('price')) {
            $prices = explode('-', $priceSlider);

            $lowPrice = !empty($prices[0]) ? (float)$prices[0] : $this->data['minPrice'];
            $highPrice = !empty($prices[1]) ? (float)$prices[1] : $this->data['maxPrice'];

            if ($lowPrice && $highPrice) {
                $products = $products->where('price', '>=', $lowPrice)
                    ->where('price', '<=', $highPrice)
                    ->orWhereHas('variants', function ($query) use ($lowPrice, $highPrice) {
                        $query->where('price', '>=', $lowPrice)
                            ->where('price', '<=', $highPrice);
                    });

                $this->data['minPrice'] = $lowPrice;
                $this->data['maxPrice'] = $highPrice;
            }
        }

        return $products;
    }

    public function _filterProductsByAttribute($products, $request)
    {
        if ($attributeOptionID = $request->query('option')) {
            $attributeOption = AttributeOption::findOrFail($attributeOptionID);

            $products = $products->whereHas('ProductAttributeValues', function ($query) use ($attributeOption) {
                $query->where('attribute_id', $attributeOption->attribute_id)
                    ->where('text_value', $attributeOption->name);
            });
        }

        return $products;
    }

    public function _sortProducts($products, $request)
    {
        if ($sort = preg_replace('/\s+/', '',$request->query('sort'))) {
            $availableSorts = ['price', 'created_at'];
            $availableOrder = ['asc', 'desc'];
            $sortAndOrder = explode('-', $sort);

            $sortBy = strtolower($sortAndOrder[0]);
            $orderBy = strtolower($sortAndOrder[1]);

            if (in_array($sortBy, $availableSorts) && in_array($orderBy, $availableOrder)) {
                $products = $products->orderBy($sortBy, $orderBy);
            }

            $this->data['selectedSort'] = url('products?sort='. $sort);
        }

        return $products;
    }

    public function getAttributeValue($product, $attribute)
    {
        return ProductAttributeValue::getAttributeOptions($product, $attribute)
            ->pluck('text_value', 'text_value');
    }

    public function _getParentCategories()
    {
        return Category::parentCategories()
            ->orderBy('name', 'asc')
            ->get();
    }

    public function _getAttributeOption($key)
    {
        return AttributeOption::whereHas('attribute', function ($query) use ($key) {
            $query->where('code', $key)->where('is_filterable', 1);
        })->orderBy('name', 'asc')->get();
    }

    public function _getSortOption()
    {
        return [
            url('product') => 'Default',
            url('product?sort=price-asc') => 'Price - Low to High',
            url('product?sort=price-desc') => 'Price - High to Low',
            url('product?sort=created_at-desc') => 'Newest to Oldest',
            url('product?sort=created_at-asc') => 'Oldest to Newest',
        ];
    }
    
    public function _price($key)
    {
        if ($key == 'min') {
            return $this->product->min('price');
        } else {
            return $this->product->max('price');
        }
    }

    public function popular()
    {
        return $this->product->popular()->with('productImages','variants')->get();
    }
}