<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Shipment;

class orderRepository
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
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

        $query = $this->order->orderBy($column, $dir)->where('seler_id', auth()->user()->id);

        if ($search) {
            $query->where(function($query) use ($search) {
                $query->where('code', 'like', '%' . $search . '%')
                    ->orWhere('customer_first_name', 'like', '%'. $search .'%')
                    ->orWhere('customer_last_name', 'like', '%'. $search .'%');
            });
        }

        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', '=', strtolower($request->status));
        }

        $startDate = $request->start;
		$endDate = $request->end;

		if ($startDate && $endDate) {
			$query->whereRaw('DATE(order_date) >= ?', $startDate)
			    ->whereRaw('DATE(order_date) <= ? ', $endDate);
		}

        $data = $query->paginate($length);
        return $data;
    }

    public function detail($id)
    {
        return $this->order->withTrashed()->findOrFail($id);
    }

    public function detailShipment($id)
    {
        return Shipment::findOrFail($id);
    }
}
