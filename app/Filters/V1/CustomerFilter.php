<?php

namespace App\Filters\V1 ;

use App\Filters\ApiFilter;
use Illuminate\Http\Request ;

class CustomerFilter extends ApiFilter{
    protected array $allowedParams =[
        'id'=>['eq','gt','lt','gte','ne'],
        'name'=> ['eq','ne'],
        'type'=> ['eq','ne'],
        'email'=> ['eq','ne'],
        'address'=> ['eq','ne'],
        'city'=> ['eq','ne'],
        'state'=> ['eq','ne'],
        'PostalCode'=>['eq','gt','lt','gte','lte','ne']
    ];

    protected array $columnMap =[
        'postalCode'=> 'postal_code'
    ];
}
