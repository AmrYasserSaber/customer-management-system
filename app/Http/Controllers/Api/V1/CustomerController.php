<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\CustomerFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\DeleteCustomerRequest;
use App\Http\Requests\V1\ShowCustomerRequest;
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    public function index(ShowCustomerRequest $request): CustomerCollection
    {
        $filter = new  CustomerFilter();
        $filterItems = $filter->transform( $request);//[['column','operator','value']]

        $includeInvoices = $request->query('includeInvoices');

        $customers = Customer::where($filterItems);
        if ($includeInvoices){
            $customers = $customers->with('invoices');
        }

        return new CustomerCollection($customers->paginate()->appends($request->query()));
    }

    public function store(StoreCustomerRequest $request): CustomerResource
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    public function show(Customer $customer ,Request $request): CustomerResource
    {
        $includeInvoices = $request->query('includeInvoices');
        if ($includeInvoices){
            return  new CustomerResource($customer->loadMissing('invoices'));
        }

        return new CustomerResource($customer);
    }

    public function update(UpdateCustomerRequest $request, Customer $customer): void
    {
        $customer->update($request->all());
    }
    public function destroy(Customer $customer,DeleteCustomerRequest $request): \Illuminate\Http\Response
    {
        if ($customer->delete()) {
            return response(['deleted' => true]);
        }

        return response(['deleted' => false], 500);
    }

}
