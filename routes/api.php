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

// Public Routes No --Authentication Required
Route::middleware(['JsonRes'])
    ->prefix('public')
    ->namespace('App\Http\Controllers\Api')
    ->group(function () {

        // Users Api (getUsers,Register -- Users)
        Route::get('/GetUsers', 'UsersController@getUsersApi');
        Route::post('/AddUser', 'UsersController@addUserApi');
        Route::post('/UserLogin', 'UsersController@userLoginApi');
    });

// Public Routes --Authentication Required
Route::prefix('public')
    ->namespace('App\Http\Controllers\Api')
    ->middleware(['api', 'auth:sanctum' , 'JsonRes'])
    ->group(function () {

        //Users CURD for Authentication Users Only
        Route::get('/GetUserById/{id}', 'UsersController@GetUserByIdApi');
        Route::post('/UpdateUser/{id}', 'UsersController@UpdateUserAPI');
        Route::get('/DeleteUser/{id}', 'UsersController@DeleteUserAPI');
        Route::post('/logout', 'UsersController@userLogoutApi');

    });

// Admin Protected Routes
Route::prefix('admin')
    ->namespace('App\Http\Controllers\Api\Admin')
    ->middleware(['api', 'auth:sanctum' , 'JsonRes'])
    ->group(function () {

        //Manage Roles: Add,Update and Delete Users Role (Ex: Customer,Service Provider,Service Admin and Super Admin).
        Route::get('/GetRoles', 'AdminController@getRolesApi');
        Route::post('/AddRole', 'AdminController@addRolesApi');
        Route::get('/GetRoleById/{id}', 'AdminController@GetRoleByIdApi');
        Route::post('/UpdateRole/{id}', 'AdminController@UpdateRoleAPI');
        Route::get('/DeleteRole/{id}', 'AdminController@DeleteRoleAPI');

        //Manage Services: Add,Update and Delete Services (Ex: Car Wash, Car Wax, Full Service).
        Route::get('/GetServices', 'AdminController@getServicesApi');
        Route::post('/AddService', 'AdminController@addServicesApi');
        Route::get('/GetServiceById/{id}', 'AdminController@GetServiceByIdApi');
        Route::post('/UpdateService/{id}', 'AdminController@UpdateServiceAPI');
        Route::get('/DeleteService/{id}', 'AdminController@DeleteServiceAPI');

    });

// Customers Protected Routes
Route::prefix('customer')
    ->namespace('App\Http\Controllers\Api\Customers')
    ->middleware(['api', 'auth:sanctum', 'JsonRes'])
    ->group(function () {

        //MainController: Contain functions like (Services list, Offer list ,Car colors list, Car Models list...etc) for auth-customers.
        Route::get('/GetServices', 'MainController@getServicesApi');
        Route::get('/GetOffers', 'MainController@getOffersApi');
        Route::get('/GetCarColors', 'MainController@getCarColorsApi'); //it should be dropdown menu in the app to select car color.
        Route::get('/GetCarModels', 'MainController@getCarModelsApi'); //it should be dropdown menu in the app to select car model.
        Route::post('/addVehicle', 'MainController@addVehicleApi');

    });

Route::prefix('service-provider')
    ->namespace('App\Http\Controllers\Api\ServiceProvider')
    ->middleware(['api', 'auth:sanctum', 'JsonRes'])
    ->group(function () {
        // Service Provider Routes
        // Define routes for Service Provider here
    });