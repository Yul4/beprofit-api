<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'orderID'                   => $this->order_ID,
            'shopID'                    => $this->order_ID,
            'name'                      => $this->name,
            'country'                   => $this->country,
            'province'                  => $this->province,
            'currency'                  => $this->currency,
            'totalWeight'               => $this->total_weight,
            'totalDiscount'             => $this->total_discount,
            'totalItems'                => $this->total_items,
            'financialStatus'           => $this->financial_status,
            'fulfillmentStatus'         => $this->fulfillment_status,
            'totalPrice'                => $this->total_price,
            'subtotalPrice'             => $this->subtotal_price,
            'processedAt'               => $this->processed_at,
            'createdAt'                 => $this->created_at,
            'updatedAt'                 => $this->updated_at,
            'totalProductionCost'       => $this->total_production_cost,
            'totalOrderShippingCost'    => $this->total_order_shipping_cost,
            'totalOrderHandlingCost'    => $this->total_order_handling_cost,
            'totalTax'                  => $this->total_tax
        ];
    }
}
