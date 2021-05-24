<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequest;
use App\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();

        return response($movies, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MovieRequest $request)
    {
        $movie = Movie::create([
            'code'          => $request['code'],
            'title'         => $request['title'],
            'category'      => $request['category'],
            'description'   => $request['description'],
            'year'          => $request['year'],
            'qty'           => $request['qty']
        ]);

        return response()->json($movie, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json('Movie not found', 404);
        }

        return response()->json($movie, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(MovieRequest $request, $id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json('Movie not found', 404);
        }

        $movie->update([
            'code'          => $request['code'],
            'title'         => $request['title'],
            'category'      => $request['category'],
            'description'   => $request['description'],
            'year'          => $request['year'],
            'qty'           => $request['qty']
        ]);

        return response()->json($movie, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json('Movie not found', 404);
        }

        $movie->delete();

        return response()->json('Movie deleted', 200);
    }
}
