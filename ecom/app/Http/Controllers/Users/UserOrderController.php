<?php

namespace App\Http\Controllers\Users;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserOrderController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$orders = Order::forUser(\Auth::user())
			->orderBy('created_at', 'DESC')
			->paginate(10);

		$this->data['orders'] = $orders;

		return $this->load_theme('orders.index', $this->data);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id order ID
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$order = Order::forUser(\Auth::user())->findOrFail($id);
		$this->data['order'] = $order;

		return $this->load_theme('orders.show', $this->data);
	}
}
