<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
	public const PENDING = 'pending';
	public const SHIPPED = 'shipped';

	protected $guarded = [];

	/**
	 * Relationship to the order model
	 *
	 * @return void
	 */
	public function order()
	{
		return $this->belongsTo('App\Models\Order');
	}
}
