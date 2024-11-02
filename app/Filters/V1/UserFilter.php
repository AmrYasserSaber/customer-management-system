<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class UserFilter extends ApiFilter
{
    protected array $allowedParams =[
        'id'=>['eq','gt','lt','gte','ne'],
        'name'=> ['eq','ne'],
        'email'=> ['eq','ne'],
        ];
}
