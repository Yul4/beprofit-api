<?php

namespace App\Http\Rules;

class SaleRules
{
    public const rules =[
        'orderID'   => 'required|string|max:20',
        'shopID'    => 'required|string|max:20',
        'name'      => 'required|string|max:30'
    ];
}
