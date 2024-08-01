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
    ->middleware(['api', 'auth:sanctum', 'JsonRes'])
    ->group(function () {
        // Users CURD for Authentication Users Only
        Route::get('/GetUserById/{id}', 'UsersController@GetUserByIdApi');
        Route::post('/UpdateUser/{id}', 'UsersController@UpdateUserAPI');
        Route::get('/DeleteUser/{id}', 'UsersController@DeleteUserAPI');
        Route::post('/logout', 'UsersController@userLogoutApi');
    });

// Admin Protected Routes
Route::prefix('admin')
    ->namespace('App\Http\Controllers\Api\Admin')
    ->middleware(['api', 'auth:sanctum', 'JsonRes', 'role:admin'])
    ->group(function () {

// Manage Roles: Add,Update and Delete User Role's (Ex: Customer,Service Provider,Service Admin and Super Admin).
        Route::get('/GetRoles', 'AdminController@getRolesApi');
        Route::post('/AddRole', 'AdminController@addRolesApi');
        Route::get('/GetRoleById/{id}', 'AdminController@GetRoleByIdApi');
        Route::post('/UpdateRole/{id}', 'AdminController@UpdateRoleAPI');
        Route::get('/DeleteRole/{id}', 'AdminController@DeleteRoleAPI');

// Manage Main Lisiting: Contain functions like (Manage iWash Services, Manage Offers, Manage Car colors ,Manage Car Models, Manage Payment Provider...etc).

        // Manage Services: Add,Update and Delete Services (Ex: Car Wash, Car Wax, Full Service).
        Route::get('/GetServices', 'AdminController@getServicesApi');
        Route::post('/AddService', 'AdminController@addServicesApi');
        Route::get('/GetServiceById/{id}', 'AdminController@GetServiceByIdApi');
        Route::post('/UpdateService/{id}', 'AdminController@UpdateServiceAPI');
        Route::get('/DeleteService/{id}', 'AdminController@DeleteServiceAPI');

        // Manage Colors
        Route::post('/AddCarColor', 'AdminController@addCarColorApi');
        Route::get('/GetCarColors', 'MainController@getCarColorsApi');
        Route::get('/GetColorById/{id}', 'AdminController@GetCarColorByIdApi');
        Route::post('/UpdateColor/{id}', 'AdminController@UpdateCarColorAPI');
        Route::get('/DeleteColor/{id}', 'AdminController@DeleteColorAPI');

        // Manage Models
        Route::post('/AddCarModel', 'AdminController@addCarModelApi');
        Route::get('/GetCarModels', 'MainController@getCarModelsApi');
        Route::get('/GetModelById/{id}', 'AdminController@GetCarModelByIdApi');
        Route::post('/UpdateModel/{id}', 'AdminController@UpdateCarModelAPI');
        Route::get('/DeleteModel/{id}', 'AdminController@DeleteModelAPI');

        // Manage Offers
        Route::post('/AddOffer', 'AdminController@addOfferApi');
        Route::get('/GetOffers', 'MainController@getOffersApi');
        Route::get('/GetOfferById/{id}', 'AdminController@GetOfferByIdApi');
        Route::post('/UpdateOffer/{id}', 'AdminController@UpdateOfferAPI');
        Route::get('/DeleteOffer/{id}', 'AdminController@DeleteOfferAPI');

        // Manage Payment Provider
        Route::post('/AddPaymentProvider', 'AdminController@addPaymentProviderApi');
        Route::get('/GetPaymentProvider', 'MainController@getPaymentProviderApi');
        Route::get('/GetPaymentPById/{id}', 'AdminController@GetPaymentPByIdApi');
        Route::post('/UpdatePaymentP/{id}', 'AdminController@UpdatePaymentPAPI');
        Route::get('/DeletePaymentP/{id}', 'AdminController@DeletePaymentPAPI');


    });

// Customers Protected Routes
Route::prefix('customer')
    ->namespace('App\Http\Controllers\Api\Customers')
    ->middleware(['api', 'auth:sanctum', 'JsonRes', 'role:customer'])
    ->group(function () {
        // MainController: Contain functions like (Services list, Offer list ,Car colors list, Car Models list...etc) for auth-customers.
        Route::get('/GetServices', 'MainController@getServicesApi');
        Route::get('/GetOffers', 'MainController@getOffersApi');
        Route::get('/GetCarColors', 'MainController@getCarColorsApi');  // it should be dropdown menu in the app to select car color.
        Route::get('/GetCarModels', 'MainController@getCarModelsApi');  // it should be dropdown menu in the app to select car model.
        Route::get('/GetPaymentProvider', 'MainController@getPaymentProviderApi'); // it should be dropdown menu in the app to select payment provider.
        Route::post('/addVehicle', 'MainController@addVehicleApi');

        //Book service
        Route::post('/AddBooking', 'BookingController@addBookingApi');
    });

Route::prefix('service-provider')
    ->namespace('App\Http\Controllers\Api\ServiceProvider')
    ->middleware(['api', 'auth:sanctum', 'JsonRes', 'role:service-provider'])
    ->group(function () {
        // Service Provider Routes
        // Define routes for Service Provider here
    });
