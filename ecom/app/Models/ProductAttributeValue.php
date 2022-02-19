<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeValue extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function attribute()
    {
        return $this->belongsTo('App\Models\Attribute');
    }

    public static function getAttributeOptions($product, $attributeCode)
    {
        $productVariantIDs = $product->variants->pluck('id');
        $attribute = Attribute::where('code', $attributeCode)->first();

        $attributeOptions = ProductAttributeValue::where('attribute_id', $attribute->id)
            ->whereIn('product_id', $productVariantIDs)
            ->get();

        return $attributeOptions;
    }
}
