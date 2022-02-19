<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Repositories\OrderRepository;
use App\Repositories\ShipmentRepository;

class ShipmentController extends Controller
{
    private $orderRepo;
	private $shipmentRepo;

	public function __construct(ShipmentRepository $shipmentRepo, OrderRepository $orderRepo)
	{
		parent::__construct();

        $this->orderRepo = $orderRepo;
		$this->shipmentRepo = $shipmentRepo;

        $this->data['currentAdminSubMenu1'] = 'orders';
        $this->data['currentAdminSubMenu2'] = '';
        $this->data['currentAdminMenu'] = 'shipment';
	}

	public function index()
	{
		$this->data['shipments'] = $this->shipmentRepo->list(10);
		return view('pages.shipment.index', $this->data);
	}

	public function edit($id)
	{
		$shipment = $this->orderRepo->detailShipment($id);
		$this->data['shipment'] = $shipment;
		$this->data['provinces'] = $this->getProvinces();
		$this->data['cities'] = isset($shipment->province_id) ? $this->getCities($shipment->province_id) : [];

		return view('pages.shipment.edit', $this->data);
	}

	public function update(Request $request, $id)
	{
		$request->validate([
			'track_number' => 'required|max:255',
		]);

		$order = $this->shipmentRepo->update($request, $id);

		if ($order) {
			\App\Jobs\SendMailOrderShipped::dispatch($order)->onQueue('webSeler');
			\Session::flash('success.message', 'The shipment has been updated');
			return redirect('orders/edit/'. $order->id);
		}
	}
}