<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// We are use laravel as API only. We want to return JSON on every request
Route::group(['middleware' => ['json.response']], function () {

    // login route
    Route::post('/login', 'Api\AuthController@login')->name('login.api');

    // reset password routes
    Route::group(['middleware' => 'api', 'prefix' => 'password'], function () {
        Route::post('create', 'Api\PasswordResetController@create');
        Route::get('find/{token}', 'Api\PasswordResetController@find');
        Route::post('reset', 'Api\PasswordResetController@reset');
    });

    // private routes
    Route::middleware('auth:api')->group(function () {

        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        // logout route
        Route::get('/logout', 'Api\AuthController@logout')->name('logout');

        // resources routes

        // only admin routes
        Route::group(['middleware' => ['role:Administrator']], function () {
            Route::apiResources([
                'users' => 'Api\UserController'
            ]);
        });

        // admin and manager routes
        Route::group(['middleware' => ['role:Administrator,Manager']], function () {
            Route::apiResources([
                'customers' => 'Api\CustomerController',
                'movies'    => 'Api\MovieController'
            ]);
        });

        // only manager routes
        Route::group(['middleware' => ['role:Manager']], function () {
            Route::apiResources([
                'rentals' => 'Api\RentalController'
            ]);
        });


    });

});
