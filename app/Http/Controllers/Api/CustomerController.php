<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return response($customers, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CustomerRequest $request)
    {
        $customer = Customer::create([
            'name'          => $request['name'],
            'last_name'     => $request['last_name'],
            'dni'           => $request['dni'],
            'description'   => $request['description'],
        ]);

        return response()->json($customer, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json('Customer not found', 404);
        }

        return response()->json($customer, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json('Customer not found', 404);
        }

        $customer->update([
            'name'          => $request['name'],
            'last_name'     => $request['last_name'],
            'dni'           => $request['dni'],
            'description'   => $request['description'],
        ]);

        return response()->json($customer, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json('Customer not found', 404);
        }

        $customer->delete();

        return response()->json('Customer deleted', 200);
    }
}
