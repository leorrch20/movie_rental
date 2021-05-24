<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RentalRequest;
use App\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rentals = Rental::all();

        return response($rentals, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RentalRequest $request)
    {
        $rental = Rental::create([
            'customer_id'   => $request['customer_id'],
            'movie_id'      => $request['movie_id'],
            'start_date'    => $request['start_date'],
            'end_date'      => $request['end_date']
        ]);

        return response()->json($rental, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $rental = Rental::find($id);

        if (!$rental) {
            return response()->json('Rental not found', 404);
        }

        return response()->json($rental, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RentalRequest $request, $id)
    {
        $rental = Rental::find($id);

        if (!$rental) {
            return response()->json('Rental not found', 404);
        }

        $rental->update([
            'customer_id'   => $request['customer_id'],
            'movie_id'      => $request['movie_id'],
            'start_date'    => $request['start_date'],
            'end_date'      => $request['end_date']
        ]);

        return response()->json($rental, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $rental = Rental::find($id);

        if (!$rental) {
            return response()->json('Rental not found', 404);
        }

        $rental->delete();

        return response()->json('Rental deleted', 200);
    }
}
