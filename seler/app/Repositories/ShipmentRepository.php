<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Shipment;

class ShipmentRepository
{
    private $shipment;

    public function __construct(Shipment $shipment)
    {
        $this->shipment = $shipment;
    }

    public function list($count)
    {
        return $this->shipment->join('orders', 'shipments.order_id', '=', 'orders.id')
			->where('shipped_by', auth()->user()->id)
			->whereRaw('orders.deleted_at IS NULL')
			->orderBy('shipments.created_at', 'DESC')
			->with('order')
			->paginate($count);
    }

    public function update($request, $id)
    {
        $shipment = $this->shipment->findOrFail($id);

		$order = \DB::transaction(
			function () use ($shipment, $request) {
				$shipment->track_number = $request->input('track_number');
				$shipment->status = $this->shipment::SHIPPED;
				$shipment->shipped_at = now();
				$shipment->shipped_by = \Auth::user()->id;
				
				if ($shipment->save()) {
					$shipment->order->status = Order::DELIVERED;
					$shipment->order->save();
				}

				return $shipment->order;
			}
		);

        return $order;
    }
}