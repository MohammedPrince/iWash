<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
 * |--------------------------------------------------------------------------
 * | API Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register API routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | is assigned the "api" middleware group. Enjoy building your API!
 * |
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function () {
    return 'Hi iWash!';
});

//from here

// Public Routes No --Authentication Required
Route::middleware(['JsonRes'])
    ->prefix('public')
    ->namespace('App\Http\Controllers\Api')
    ->group(function () {
        // Users Api (Register,Edit,Del,Login and Logout -- Users)
        Route::post('/AddUser', 'UsersController@addUserApi');
        Route::post('/UserLogin', 'UsersController@userLoginApi');
    });

// Public Routes --Authentication Required
Route::prefix('public')
    ->namespace('App\Http\Controllers\Api')
    ->middleware(['api', 'auth:sanctum' , 'JsonRes'])
    ->group(function () {

        Route::get('/GetUserById/{id}', 'UsersController@GetUserByIdApi')->middleware(['api', 'auth:sanctum']);
        Route::post('/UpdateUser/{id}', 'UsersController@UpdateUserAPI')->middleware(['api', 'auth:sanctum']);
        Route::get('/DeleteUser/{id}', 'UsersController@DeleteUserAPI')->middleware(['api', 'auth:sanctum']);
        
        Route::post('/logout', 'UsersController@userLogoutApi')->middleware(['api', 'auth:sanctum']);

    });

// Admin Protected Routes
Route::prefix('admin')
    ->namespace('App\Http\Controllers\Api\Admin')
    // ->middleware(['api', 'auth:sanctum'])
    ->group(function () {
        // Route::get('/', 'AdminController@index');
        // Route::post('/addAdmin', 'AdminController@addAdmin');
        // Route::post('/createOffer', 'OfferController@createOffer');
        // Route::get('/getOffers', 'OfferController@getOffers');
    });

// Customers Protected Routes
Route::prefix('customers')
    ->namespace('App\Http\Controllers\Api\Customers')
    // ->middleware(['api', 'auth:sanctum'])
    ->group(function () {
        // Route::get('/', 'CustomersController@index');
    });
