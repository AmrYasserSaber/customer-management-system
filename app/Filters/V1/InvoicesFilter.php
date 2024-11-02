<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class InvoicesFilter extends ApiFilter{
    protected array $allowedParams =[
        'id'=>['eq','gt','lt','gte','lte','ne'],
        'customerId'=> ['eq','gt','lt','gte','lte','ne'],
        'amount'=>['eq','gt','lt','gte','lte','ne'],
        'status'=> ['eq','ne'],
        'billedDate'=> ['eq','gt','lt','gte','lte','ne'],
        'paidDate'=> ['eq','gt','lt','gte','lte','ne'],

    ];
    protected array $columnMap =[
        'customerId'=>'customer_id',
        'billedDate'=>'billed_date',
        'paidDate'=>'paid_date'
    ];
}
