<?php


namespace App\Mappers;

use Illuminate\Http\Request;

class SaleMapper
{
    public static function map(Request $request, bool $isNew = null)
    {
        $data = [
			'order_ID'                  => $request->input('orderID'),
			'shop_ID'                   => $request->input('shopID'),
            'name'                      => $request->input('name'),
            'country'                   => $request->input('country'),
			'province'                  => $request->input('province'),
            'currency'                  => $request->input('currency'),
            'total_weight'              => $request->input('totalWeight'),
            'total_discount'            => $request->input('totalDiscount'),
            'total_items'               => $request->input('totalItems'),
            'financial_status'		    => $request->input('financialStatus'),
            'fulfillment_status'		=> $request->input('fulfillmentStatus'),
            'total_price'		        => $request->input('totalPrice'),
            'subtotal_price'		    => $request->input('subtotalPrice'),
            'processed_at'		        => $request->input('processedAt'),
            'created_at'		        => $request->input('createdAt'),
            'updated_at'		        => $request->input('updatedAt'),
            'closed_at'		            => $request->input('closedAt')
        ];

        if ($isNew) {
            $data['total_production_cost'] = $request->input('totalProductionCost');
            $data['total_order_shipping_cost'] = $request->input('totalOrderShippingCost');
            $data['total_order_handling_cost'] = $request->input('totalOrderHandlingCost');
            $data['total_tax'] = $request->input('totalTax');
        }

        return $data;
    }
}
