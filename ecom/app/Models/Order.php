<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $guarded = [];
	
	public const CREATED = 'created';
	public const CONFIRMED = 'confirmed';
	public const DELIVERED = 'delivered';
	public const COMPLETED = 'completed';
	public const CANCELLED = 'cancelled';

	public const ORDERCODE = 'INV';

	public const PAID = 'paid';
	public const UNPAID = 'unpaid';

	public function shipment()
	{
		return $this->hasOne('App\Models\Shipment');
	}

	public function orderItems()
	{
		return $this->hasMany('App\Models\OrderItem');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function scopeForUser($query, $user)
	{
		return $query->where('user_id', $user->id);
	}

	public static function generateCode()
	{
		$dateCode = self::ORDERCODE . '/' . date('Ymd') . '/' .\General::integerToRoman(date('m')). '/' .\General::integerToRoman(date('d')). '/';

		$lastOrder = self::select([\DB::raw('MAX(orders.code) AS last_code')])
			->where('code', 'like', $dateCode . '%')
			->first();

		$lastOrderCode = !empty($lastOrder) ? $lastOrder['last_code'] : null;
		
		$orderCode = $dateCode . '00001';
		if ($lastOrderCode) {
			$lastOrderNumber = str_replace($dateCode, '', $lastOrderCode);
			$nextOrderNumber = sprintf('%05d', (int)$lastOrderNumber + 1);
			
			$orderCode = $dateCode . $nextOrderNumber;
		}

		if (self::_isOrderCodeExists($orderCode)) {
			return generateOrderCode();
		}

		return $orderCode;
	}

	private static function _isOrderCodeExists($orderCode)
	{
		return Order::where('code', '=', $orderCode)->exists();
	}

    /**
	 * Check order is paid or not
	 *
	 * @return boolean
	 */
	public function isPaid()
	{
		return $this->payment_status == self::PAID;
	}

	/**
	 * Check order is created
	 *
	 * @return boolean
	 */
	public function isCreated()
	{
		return $this->status == self::CREATED;
	}

	/**
	 * Check order is confirmed
	 *
	 * @return boolean
	 */
	public function isConfirmed()
	{
		return $this->status == self::CONFIRMED;
	}

	/**
	 * Check order is delivered
	 *
	 * @return boolean
	 */
	public function isDelivered()
	{
		return $this->status == self::DELIVERED;
	}

	/**
	 * Check order is completed
	 *
	 * @return boolean
	 */
	public function isCompleted()
	{
		return $this->status == self::COMPLETED;
	}

	/**
	 * Check order is cancelled
	 *
	 * @return boolean
	 */
	public function isCancelled()
	{
		return $this->status == self::CANCELLED;
	}

	/**
	 * Add full_name custom attribute to order object
	 *
	 * @return boolean
	 */
	public function getCustomerFullNameAttribute()
	{
		return "{$this->customer_first_name} {$this->customer_last_name}";
	}
}
