<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Order;
use Illuminate\Http\Request;

use App\Exports\ReportPaymentExport;
use App\Exports\ReportProductExport;
use App\Exports\ReportRevenueExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\ReportInventoryExport;
use App\Repositories\ReportRepository;

class ReportController extends Controller
{
	private $reportRepo;
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct(ReportRepository $reportRepo)
	{
		parent::__construct();

		$this->reportRepo = $reportRepo;

		$this->data['currentAdminSubMenu1'] = 'reports';
        $this->data['currentAdminSubMenu2'] = '';
        $this->data['currentAdminMenu'] = '';

		$this->data['exports'] = [
			'xlsx' => 'Excel File',
			'pdf' => 'PDF File',
		];
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request request params
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function revenue(Request $request)
	{
        $this->data['currentAdminMenu'] = 'reports-revenue';

		$startDate = $request->input('start');
		$endDate = $request->input('end');

		if ($startDate && !$endDate) {
			\Session::flash('error.message', 'The end date is required if the start date is present');
			return redirect('reports/revenue');
		}

		if (!$startDate && $endDate) {
			\Session::flash('error.message', 'The start date is required if the end date is present');
			return redirect('reports/revenue');
		}

		if ($startDate && $endDate) {
			if (strtotime($endDate) < strtotime($startDate)) {
				\Session::flash('error.message', 'The end date should be greater or equal than start date');
				return redirect('reports/revenue');
			}

			$earlier = new \DateTime($startDate);
			$later = new \DateTime($endDate);
			$diff = $later->diff($earlier)->format("%a");
			
			if ($diff >= 31) {
				\Session::flash('error.message', 'The number of days in the date ranges should be lower or equal to 31 days');
				return redirect('reports/revenue');
			}
		} else {
			$currentDate = date('Y-m-d');
			$startDate = date('Y-m-01', strtotime($currentDate));
			$endDate = date('Y-m-t', strtotime($currentDate));
		}
		$this->data['startDate'] = $startDate;
		$this->data['endDate'] = $endDate;
		
		$revenues = $this->reportRepo->revenue($startDate, $endDate);

		$this->data['revenues'] = ($startDate && $endDate) ? $revenues : [];

		if ($exportAs = $request->input('export')) {
			if (!in_array($exportAs, ['xlsx', 'pdf'])) {
				\Session::flash('error.message', 'Invalid export request');
				return redirect('reports/revenue');
			}

			if ($exportAs == 'xlsx') {
				$fileName = 'report-revenue-'. $startDate .'-'. $endDate .'.xlsx';

				return Excel::download(new ReportRevenueExport($revenues), $fileName);
			}

			if ($exportAs == 'pdf') {
				$fileName = 'report-revenue-'. $startDate .'-'. $endDate .'.pdf';
				$pdf = PDF::loadView('pages.reports.exports.revenue_pdf', $this->data);

				return $pdf->download($fileName);
			}
		}

		return view('pages.reports.revenue', $this->data);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request request params
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function product(Request $request)
	{
        $this->data['currentAdminMenu'] = 'reports-product';

		$startDate = $request->input('start');
		$endDate = $request->input('end');

		if ($startDate && !$endDate) {
			\Session::flash('error.message', 'The end date is required if the start date is present');
			return redirect('reports/product');
		}

		if (!$startDate && $endDate) {
			\Session::flash('error.message', 'The start date is required if the end date is present');
			return redirect('reports/product');
		}

		if ($startDate && $endDate) {
			if (strtotime($endDate) < strtotime($startDate)) {
				\Session::flash('error.message', 'The end date should be greater or equal than start date');
				return redirect('reports/product');
			}

			$earlier = new \DateTime($startDate);
			$later = new \DateTime($endDate);
			$diff = $later->diff($earlier)->format("%a");
			
			if ($diff >= 31) {
				\Session::flash('error.message', 'The number of days in the date ranges should be lower or equal to 31 days');
				return redirect('reports/product');
			}
		} else {
			$currentDate = date('Y-m-d');
			$startDate = date('Y-m-01', strtotime($currentDate));
			$endDate = date('Y-m-t', strtotime($currentDate));
		}
		$this->data['startDate'] = $startDate;
		$this->data['endDate'] = $endDate;

		$products = $this->reportRepo->product($startDate, $endDate);

		$this->data['products'] = ($startDate && $endDate) ? $products : [];

		if ($exportAs = $request->input('export')) {
			if (!in_array($exportAs, ['xlsx', 'pdf'])) {
				\Session::flash('error.message', 'Invalid export request');
				return redirect('reports/product');
			}

			if ($exportAs == 'xlsx') {
				$fileName = 'report-product-'. $startDate .'-'. $endDate .'.xlsx';

				return Excel::download(new ReportProductExport($products), $fileName);
			}

			if ($exportAs == 'pdf') {
				$fileName = 'report-product-'. $startDate .'-'. $endDate .'.pdf';
				$pdf = PDF::loadView('pages.reports.exports.product_pdf', $this->data);

				return $pdf->download($fileName);
			}
		}

		return view('pages.reports.product', $this->data);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request request params
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function inventory(Request $request)
	{
		$this->data['currentAdminMenu'] = 'reports-inventory';

		$products = $this->reportRepo->inventory();

		$this->data['products'] = $products;

		if ($exportAs = $request->input('export')) {
			if (!in_array($exportAs, ['xlsx', 'pdf'])) {
				\Session::flash('error.message', 'Invalid export request');
				return redirect('reports/inventory');
			}

			if ($exportAs == 'xlsx') {
				$fileName = 'report-inventory.xlsx';

				return Excel::download(new ReportInventoryExport($products), $fileName);
			}

			if ($exportAs == 'pdf') {
				$fileName = 'report-inventory.pdf';
				$pdf = PDF::loadView('pages.reports.exports.inventory_pdf', $this->data);

				return $pdf->download($fileName);
			}
		}

		return view('pages.reports.inventory', $this->data);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request request params
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function payment(Request $request)
	{
		$this->data['currentAdminMenu'] = 'reports-payment';

		$startDate = $request->input('start');
		$endDate = $request->input('end');

		if ($startDate && !$endDate) {
			\Session::flash('error.message', 'The end date is required if the start date is present');
			return redirect('reports/payment');
		}

		if (!$startDate && $endDate) {
			\Session::flash('error.message', 'The start date is required if the end date is present');
			return redirect('reports/payment');
		}

		if ($startDate && $endDate) {
			if (strtotime($endDate) < strtotime($startDate)) {
				\Session::flash('error.message', 'The end date should be greater or equal than start date');
				return redirect('reports/payment');
			}

			$earlier = new \DateTime($startDate);
			$later = new \DateTime($endDate);
			$diff = $later->diff($earlier)->format("%a");
			
			if ($diff >= 31) {
				\Session::flash('error.message', 'The number of days in the date ranges should be lower or equal to 31 days');
				return redirect('reports/payment');
			}
		} else {
			$currentDate = date('Y-m-d');
			$startDate = date('Y-m-01', strtotime($currentDate));
			$endDate = date('Y-m-t', strtotime($currentDate));
		}
		$this->data['startDate'] = $startDate;
		$this->data['endDate'] = $endDate;

		$payments = $this->reportRepo->payment($startDate, $endDate);

		$this->data['payments'] = ($startDate && $endDate) ? $payments : [];

		if ($exportAs = $request->input('export')) {
			if (!in_array($exportAs, ['xlsx', 'pdf'])) {
				\Session::flash('error.message', 'Invalid export request');
				return redirect('reports/payment');
			}

			if ($exportAs == 'xlsx') {
				$fileName = 'report-payment-'. $startDate .'-'. $endDate .'.xlsx';

				return Excel::download(new ReportPaymentExport($payments), $fileName);
			}

			if ($exportAs == 'pdf') {
				$fileName = 'report-payment-'. $startDate .'-'. $endDate .'.pdf';
				$pdf = PDF::loadView('pages.reports.exports.payment_pdf', $this->data);

				return $pdf->download($fileName);
			}
		}

		return view('pages.reports.payment', $this->data);
	}
}