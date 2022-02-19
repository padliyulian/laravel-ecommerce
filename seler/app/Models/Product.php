<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public const DRAFT = 1;
	public const ACTIVE = 2;
	public const INACTIVE = 3;

	public const STATUSES = [
		self::DRAFT => 'draft',
		self::ACTIVE => 'active',
		self::INACTIVE => 'inactive',
	];

	public const SIMPLE = 'simple';
	public const CONFIGURABLE = 'configurable';
	public const TYPES = [
		self::SIMPLE => 'Simple',
		self::CONFIGURABLE => 'Configurable',
	];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function createdBy()
	{
		return $this->belongsTo('App\Models\User','created_by');
	}

    public function updatedBy()
	{
		return $this->belongsTo('App\Models\User','updated_by');
	}

    public function parent()
    {
        return $this->belongsTo('App\Models\Product', 'parent_id');
    }

    public function categories()
	{
		return $this->belongsToMany('App\Models\Category', 'product_categories');
	}

    public function variants()
    {
        return $this->hasMany('App\Models\Product', 'parent_id')->with('productInventory');
    }

    public function productImages()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function productInventory()
	{
		return $this->hasOne('App\Models\ProductInventory');
	}

    public function productAttributeValues()
    {
        return $this->hasMany('App\Models\ProductAttributeValue');
    }



    public static function statuses()
	{
		return self::STATUSES;
	}

    public static function types()
	{
		return self::TYPES;
	}

    public function statusLabel()
	{
		$statuses = $this->statuses();

		return isset($this->status) ? $statuses[$this->status] : null;
	}

}
