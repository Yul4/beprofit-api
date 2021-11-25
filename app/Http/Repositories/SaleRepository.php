<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\DB;

class SaleRepository
{
    public static function summary($from = null, $to = null)
    {
        $query = DB::table('sales')
            ->selectRaw('SUM(IF(financial_status = "paid" or financial_status = "partially_paid", total_price, 0)) netSales')
            ->selectRaw('SUM(IF(financial_status = "refunded", total_price, 0)) refunds')
            ->selectRaw('SUM(IF(financial_status = "paid" or financial_status = "partially_paid", total_production_cost, 0)) productionCosts')
            ->selectRaw('SUM(IF(fulfillment_status != "unfulfilled", total_order_shipping_cost, 0)) shippingCosts')
            ->selectRaw('SUM(IF(fulfillment_status != "unfulfilled", total_order_handling_cost, 0)) handlingCosts');

        if ($from) {
            $query->where('processed_at', '>', $from);
        }

        if ($to) {
            $query->where('processed_at', '<', $to);
        }

        return $query->first();
    }
}
