<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderItem;
use App\Models\ProductInventory;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    private $orderRepo;

	public function __construct(OrderRepository $orderRepo)
	{
        parent::__construct();
        $this->orderRepo = $orderRepo;
		$this->data['currentAdminSubMenu1'] = 'orders';
        $this->data['currentAdminSubMenu2'] = '';
        $this->data['currentAdminMenu'] = 'order';
		$this->data['statuses'] = Order::STATUSES;
	}

	public function index(Request $request)
	{
        $startDate = $request->start;
		$endDate = $request->end;

		if ($startDate && !$endDate) {
			\Session::flash('error.message', 'The end date is required if the start date is present');
			return redirect('orders');
		}

		if (!$startDate && $endDate) {
			\Session::flash('error.message', 'The start date is required if the end date is present');
			return redirect('orders');
		}

		if ($startDate && $endDate) {
			if (strtotime($endDate) < strtotime($startDate)) {
				\Session::flash('error.message', 'The end date should be greater or equal than start date');
				return redirect('orders');
			}
		}
        
        $this->data['orders'] = $this->orderRepo->list($request);
        return view('pages.order.index', $this->data);
	}

    public function edit($id)
    {
		$this->data['order'] = $this->orderRepo->detail($id);
        return view('pages.order.edit', $this->data);
    }

    public function doComplete(Request $request, $id)
	{
		$order = Order::findOrFail($id);
		
		if (!$order->isDelivered()) {
			\Session::flash('error.message', 'Mark as complete the order can be done if the latest status is delivered');
			return redirect('orders');
		}

		$order->status = Order::COMPLETED;
		$order->approved_by = \Auth::user()->id;
		$order->approved_at = now();
		
		if ($order->save()) {
			\Session::flash('success.message', 'The order has been marked as completed!');
			return redirect('orders');
		}
	}

    public function cancel($id)
	{
		$order = Order::where('id', $id)
			->whereIn('status', [Order::CREATED, Order::CONFIRMED])
			->firstOrFail();

		$this->data['order'] = $order;

		return view('pages.order.cancel', $this->data);
	}

    public function doCancel(Request $request, $id)
	{
		$request->validate(
			[
				'cancellation_note' => 'required|max:255',
			]
		);

		$order = Order::findOrFail($id);
		
		$cancelOrder = \DB::transaction(
			function () use ($order, $request) {
				$params = [
					'status' => Order::CANCELLED,
					'cancelled_by' => \Auth::user()->id,
					'cancelled_at' => now(),
					'cancellation_note' => $request->input('cancellation_note'),
				];

				if ($cancelOrder = $order->update($params) && $order->orderItems->count() > 0) {
					foreach ($order->orderItems as $item) {
						ProductInventory::increaseStock($item->product_id, $item->qty);
					}
				}
				
				return $cancelOrder;
			}
		);

		\Session::flash('success.message', 'The order has been cancelled');

		return redirect('orders');
	}

    public function destroy($id)
	{
		$order = Order::withTrashed()->findOrFail($id);

		if ($order->trashed()) {
			$canDestroy = \DB::transaction(
				function () use ($order) {
					Payment::where('order_id', $order->id)->delete();
					OrderItem::where('order_id', $order->id)->delete();
					$order->shipment->delete();
					$order->forceDelete();

					return true;
				}
			);

			if ($canDestroy) {
				\Session::flash('success.message', 'The order has been removed permanently');
			} else {
				\Session::flash('success.message', 'The order could not be removed permanently');
			}

			return redirect('orders/trashed');
		} else {
			$canDestroy = \DB::transaction(
				function () use ($order) {
					if (!$order->isCancelled()) {
						foreach ($order->orderItems as $item) {
							ProductInventory::increaseStock($item->product_id, $item->qty);
						}
					};

					$order->delete();

					return true;
				}
			);
			
			if ($canDestroy) {
				\Session::flash('success.message', 'The order has been removed');
			} else {
				\Session::flash('success.message', 'The order could not be removed');
			}

			return redirect('orders');
		}
	}

    public function trashed()
	{
		$this->data['currentAdminSubMenu1'] = 'orders';
        $this->data['currentAdminSubMenu2'] = '';
        $this->data['currentAdminMenu'] = 'trash';
		$this->data['orders'] = Order::onlyTrashed()->orderBy('created_at', 'DESC')->paginate(10);
		return view('pages.order.trashed', $this->data);
	}

	public function restore($id)
	{
		$order = Order::onlyTrashed()->findOrFail($id);

		$canRestore = \DB::transaction(
			function () use ($order) {
				$isOutOfStock = false;
				if (!$order->isCancelled()) {
					foreach ($order->orderItems as $item) {
						try {
							ProductInventory::reduceStock($item->product_id, $item->qty);
						} catch (OutOfStockException $e) {
							$isOutOfStock = true;
							\Session::flash('error.message', $e->getMessage());
						}
					}
				};

				if ($isOutOfStock) {
					return false;
				} else {
					return $order->restore();
				}
			}
		);

		if ($canRestore) {
			\Session::flash('success.message', 'The order has been restored');
			return redirect('orders');
		} else {
			if (!\Session::has('error')) {
				\Session::flash('error.message', 'The order could not be restored');
			}
			return redirect('orders/trashed');
		}
	}
}
