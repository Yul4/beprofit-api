<?php


namespace App\Mappers;

class SummaryMapper
{
    public static function map($summary)
    {
        $shipping = $summary->shippingCosts + $summary->handlingCosts;
        $grossProfit = $summary->netSales - $shipping;

        $grossMargin = $summary->netSales ? $grossProfit * 100 / $summary->netSales : 0;

        return [
            'netSales'          => $summary->netSales,
            'refunds'           => $summary->refunds,
            'productionCosts'   => $summary->productionCosts,
            'shipping'          => $summary->shippingCosts + $summary->handlingCosts,
            'grossProfit'       => $grossProfit,
            'grossMargin'       => $grossMargin
        ];
    }
}
