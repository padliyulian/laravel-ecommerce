<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use App\Models\Attribute;
use App\Models\ProductImage;
use App\Models\AttributeOption;
use App\Models\ProductInventory;
use App\Models\ProductAttributeValue;

class ProductRepository
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
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

        $query = $this->product->orderBy($column, $dir)->where('created_by', auth()->user()->id);

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
        $data = DB::transaction(function () use ($request) {

			$product = new $this->product;
            $product->sku = $request->sku;
            $product->type = $request->type;
            $product->user_id = auth()->user()->id;
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->price = $request->price;
            $product->weight = $request->weight;
            $product->width = $request->width;
            $product->height = $request->height;
            $product->length = $request->length;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->status = $request->status;
            $product->created_by = auth()->user()->id;
            $product->save();

            if (count($request->category_ids) > 0) {
                $product->categories()->sync($request->category_ids);
            }

			if ($request->type == 'configurable') {
				$this->generateProductVariants($product, $request);
			}

			return $product;
		});

        return $data;
    }

    public function detail($id)
    {
        return $this->product::with('variants','productInventory')->findOrFail($id);
    }

    public function update($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

			$product = $this->product::findOrFail($id);
            $product->sku = $request->sku;
            $product->type = $request->type;
            $product->user_id = auth()->user()->id;
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->price = $request->price;
            $product->weight = $request->weight;
            $product->width = $request->width;
            $product->height = $request->height;
            $product->length = $request->length;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->status = $request->status;
            $product->created_by = auth()->user()->id;
            $product->save();

            if (count($request->category_ids) > 0) {
                $product->categories()->sync($request->category_ids);
            }

            if ($product->type == 'configurable') {
                $this->updateProductVariants($request);
            } else {
                ProductInventory::updateOrCreate(['product_id' => $product->id], ['qty' => $request->qty]);
            }

			return $product;
		});
    }

    public function delete($id)
    {
        $product = $this->product::findOrFail($id);
        $product->delete();
        return $product;
    }

    public function addImage($request, $id)
    {
        $product = $this->product::findOrFail($id);

        $image = $request->file('image');
        $name = $product->slug . '_' . time();
        $fileName = $name . '.' . $image->getClientOriginalExtension();
        $folder = env('URL_IMAGE_PRODUCT');
        $filePath = $image->storeAs($folder, $fileName, 'public');

        $product_image = new ProductImage;
        $product_image->product_id = $product->id;

        $product_image->path = $filePath;
        $resizedImage = $this->_resizeImage($image, $fileName, $folder);
        foreach ($resizedImage as $key => $val) {
            if ($key == 'small') {
                $product_image->small = $val;
            }
            if ($key == 'medium') {
                $product_image->medium = $val;
            }
            if ($key == 'large') {
                $product_image->large = $val;
            }
            if ($key == 'extra_large') {
                $product_image->extra_large = $val;
            }
        }

        $product_image->created_by = auth()->user()->id;
        $product_image->save();

        return $product_image;
    }

    private function _resizeImage($image, $fileName, $folder)
	{
		$resizedImage = [];

		$smallImageFilePath = $folder . '/small/' . $fileName;
		$size = explode('x', ProductImage::SMALL);
		list($width, $height) = $size;

		$smallImageFile = \Image::make($image)->fit($width, $height)->stream();
		if (\Storage::put('public/' . $smallImageFilePath, $smallImageFile)) {
			$resizedImage['small'] = $smallImageFilePath;
		}
		
		$mediumImageFilePath = $folder . '/medium/' . $fileName;
		$size = explode('x', ProductImage::MEDIUM);
		list($width, $height) = $size;

		$mediumImageFile = \Image::make($image)->fit($width, $height)->stream();
		if (\Storage::put('public/' . $mediumImageFilePath, $mediumImageFile)) {
			$resizedImage['medium'] = $mediumImageFilePath;
		}

		$largeImageFilePath = $folder . '/large/' . $fileName;
		$size = explode('x', ProductImage::LARGE);
		list($width, $height) = $size;

		$largeImageFile = \Image::make($image)->fit($width, $height)->stream();
		if (\Storage::put('public/' . $largeImageFilePath, $largeImageFile)) {
			$resizedImage['large'] = $largeImageFilePath;
		}

		$extraLargeImageFilePath  = $folder . '/xlarge/' . $fileName;
		$size = explode('x', ProductImage::EXTRA_LARGE);
		list($width, $height) = $size;

		$extraLargeImageFile = \Image::make($image)->fit($width, $height)->stream();
		if (\Storage::put('public/' . $extraLargeImageFilePath, $extraLargeImageFile)) {
			$resizedImage['extra_large'] = $extraLargeImageFilePath;
		}

		return $resizedImage;
	}

    public function deleteImage($id)
    {
        $product_image = ProductImage::findOrFail($id);
        if ($product_image->delete()) {
            Storage::delete('public/'.$product_image->path);
            Storage::delete('public/'.$product_image->small);
            Storage::delete('public/'.$product_image->medium);
            Storage::delete('public/'.$product_image->large);
            Storage::delete('public/'.$product_image->extra_large);
        }
        return $product_image;
    }

    public function listOfStatus() {
        return $this->product::statuses();
    }

    public function listOfType() {
        return $this->product::types();
    }

    public function getConfigurableAttributes()
	{
		return Attribute::where('is_configurable', true)->with('attributeOptions')->get();
	}


    private function updateProductVariants($request)
    {
        if ($request->variants) {
            foreach ($request->variants as $productParams) {
                $product = $this->product->find($productParams['id']);
                $product->price = $productParams['price'];
                $product->weight = $productParams['weight'];
                $product->status = $request->status;
                $product->updated_by = auth()->user()->id;
                $product->update();
                
                ProductInventory::updateOrCreate(['product_id' => $product->id], ['qty' => $productParams['qty']]);
            }
        }
    }

    private function generateProductVariants($product, $request)
    {
        $configurableAttributes = $this->getConfigurableAttributes();

        $variantAttributes = [];
        foreach ($configurableAttributes as $attribute) {
            $variantAttributes[$attribute->code] = $request[$attribute->code];
        }

        $variants = $this->generateAttributeCombinations($variantAttributes);
        
        if ($variants) {
            foreach ($variants as $variant) {

                $newProductVariant = new $this->product;
                $newProductVariant->parent_id = $product->id;
                $newProductVariant->user_id = auth()->user()->id;
                $newProductVariant->sku = $product->sku . '-' .implode('-', array_values($variant));
                $newProductVariant->type = 'simple';
                $newProductVariant->name = $product->name . $this->convertVariantAsName($variant);
                $newProductVariant->slug = Str::slug($product->name);
                $newProductVariant->created_by = auth()->user()->id;
                $newProductVariant->save();

                $categoryIds = !empty($request['category_ids']) ? $request['category_ids'] : [];
                $newProductVariant->categories()->sync($categoryIds);

                $this->saveProductAttributeValues($newProductVariant, $variant);
            }
        }
    }

    private function generateAttributeCombinations($arrays)
    {
        $result = [[]];
        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }

    private function convertVariantAsName($variant)
    {
        $variantName = '';
        
        foreach (array_keys($variant) as $key => $code) {
            $attributeOptionID = $variant[$code];
            $attributeOption = AttributeOption::find($attributeOptionID);
            
            if ($attributeOption) {
                $variantName .= ' - ' . $attributeOption->name;
            }
        }

        return $variantName;
    }

    private function saveProductAttributeValues($product, $variant)
    {
        foreach (array_values($variant) as $attributeOptionID) {
            $attributeOption = AttributeOption::find($attributeOptionID);
           
            $product_attrubute_value = new ProductAttributeValue;
            $product_attrubute_value->product_id = $product->id;
            $product_attrubute_value->attribute_id = $attributeOption->attribute_id;
            $product_attrubute_value->text_value = $attributeOption->name;
            $product_attrubute_value->save();
         }
    }
}
