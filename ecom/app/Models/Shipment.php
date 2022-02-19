<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
	public const PENDING = 'pending';
	public const SHIPPED = 'shipped';

	protected $guarded = [];
}
