<?php

namespace App\Repositories;

use App\Models\Order;

class ReportRepository
{
    public function revenue($startDate, $endDate)
	{
		$sql = "WITH recursive date_ranges AS (
			SELECT :start_date_series AS date
			UNION ALL
			SELECT date + INTERVAL 1 DAY
			FROM date_ranges
			WHERE date < :end_date_series
			),
			filtered_orders AS (
				SELECT * 
				FROM orders
				WHERE seler_id = ".auth()->user()->id." 
					AND DATE(order_date) >= :start_date
					AND DATE(order_date) <= :end_date
					AND status = :status
					AND payment_status = :payment_status
			)

		 SELECT 
			 DISTINCT DR.date,
			 COUNT(FO.id) num_of_orders,
			 COALESCE(SUM(FO.grand_total),0) gross_revenue,
			 COALESCE(SUM(FO.tax_amount),0) taxes_amount,
			 COALESCE(SUM(FO.shipping_cost),0) shipping_amount,
			 COALESCE(SUM(FO.grand_total - FO.tax_amount - FO.shipping_cost - FO.discount_amount),0) net_revenue
		 FROM date_ranges DR
		 LEFT JOIN filtered_orders FO ON DATE(order_date) = DR.date
		 GROUP BY DR.date
		 ORDER BY DR.date ASC";

		$revenues = \DB::select(
			\DB::raw($sql),
			[
				'start_date_series' => $startDate,
				'end_date_series' => $endDate,
				'start_date' => $startDate,
				'end_date' => $endDate,
				'status' => Order::COMPLETED,
				'payment_status' => Order::PAID,
			]
		);

		return $revenues;
	}

    public function product($startDate, $endDate)
	{
		$sql = "
            SELECT
                OI.product_id,
                OI.name,
                OI.sku,
                SUM(OI.qty) as items_sold,
                COALESCE(SUM(OI.sub_total - OI.tax_amount - OI.discount_amount),0) net_revenue,
                COUNT(OI.order_id) num_of_orders,
                PI.qty as stock
            FROM order_items OI
            LEFT JOIN orders O ON O.id = OI.order_id
            LEFT JOIN product_inventories PI ON PI.product_id = OI.product_id
            WHERE O.seler_id = ".auth()->user()->id."
                AND DATE(O.order_date) >= :start_date
                AND DATE(O.order_date) <= :end_date
                AND O.status = :status
                AND O.payment_status = :payment_status
            GROUP BY OI.product_id, OI.name, OI.sku, PI.qty
		";

		$products = \DB::select(
			\DB::raw($sql),
			[
				'start_date' => $startDate,
				'end_date' => $endDate,
				'status' => Order::COMPLETED,
				'payment_status' => Order::PAID,
			]
		);

        return $products;
	}

    public function inventory()
	{
		$sql = "
            SELECT
                P.*,
                PI.qty as stock
            FROM product_inventories PI
            LEFT JOIN products P ON P.id = PI.product_id
            WHERE P.created_by = ".auth()->user()->id."
            ORDER BY stock ASC
		";

		$products = \DB::select(\DB::raw($sql));

		return $products;
	}

    public function payment($startDate, $endDate)
	{
		$sql = "
            SELECT
                O.code,
                P.*
            FROM payments P
            LEFT JOIN orders O ON O.id = P.order_id
            WHERE O.seler_id = ".auth()->user()->id."
                AND DATE(P.created_at) >= :start_date
                AND DATE(P.created_at) <= :end_date
            ORDER BY created_at DESC
		";

		$payments = \DB::select(
			\DB::raw($sql),
			[
				'start_date' => $startDate,
				'end_date' => $endDate
			]
		);

		return $payments;
	}
}