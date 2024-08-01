<?php

namespace App\Http\Controllers\Api\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralValidation;
use App\Services\IWashService;

class MainController extends Controller
{
    protected $iwashService;

    public function __construct(IWashService $iwashService)
    {
        $this->iwashService = $iwashService;
    }

    // Get Service for Customers
    public function getServicesApi()
    {
        $result = $this->iwashService->getServices();

        if ($result['success']) {
            return response()->json([
                'services' => [
                    'status' => 'success',
                    'message' => 'Service Details',
                    'data' => $result['services'],
                ]
            ], 200);
        } else {
            return response()->json([
                'services' => [
                    'status' => 'error',
                    'error' => $result['message']
                ]
            ], 422);
        }
    }

    // Get Offers for Customers
    public function getOffersApi()
    {
        $result = $this->iwashService->getOffers();

        if ($result['success']) {
            return response()->json([
                'offers' => [
                    'status' => 'success',
                    'message' => 'Offer Details',
                    'data' => $result['offers'],
                ]
            ], 200);
        } else {
            return response()->json([
                'offers' => [
                    'status' => 'error',
                    'error' => $result['message']
                ]
            ], 422);
        }
    }
    
    // Get Car Colors List for Customers
    public function getCarColorsApi()
    {
        $result = $this->iwashService->getCarColors();

        if ($result['success']) {
            return response()->json([
                'colors' => [
                    'status' => 'success',
                    'message' => 'Color Details',
                    'data' => $result['colors'],
                ]
            ], 200);
        } else {
            return response()->json([
                'colors' => [
                    'status' => 'error',
                    'error' => $result['message']
                ]
            ], 422);
        }
    }

    // Get Car Models List for Customers
    public function getCarModelsApi()
    {
        $result = $this->iwashService->getCarModels();

        if ($result['success']) {
            return response()->json([
                'vehicle models' => [
                    'status' => 'success',
                    'message' => 'Vehicle Models Details',
                    'data' => $result['vehicle_models'],
                ]
            ], 200);
        } else {
            return response()->json([
                'vehicle_models' => [
                    'status' => 'error',
                    'error' => $result['message']
                ]
            ], 422);
        }
    }

    //Get Payment Providers
    public function getPaymentProviderApi()
    {
        $result = $this->iwashService->getPaymentProvider();

        if ($result['success']) {
            return response()->json([
                'payment provider' => [
                    'status' => 'success',
                    'message' => 'Payment Provider Details',
                    'data' => $result['payment_provider'],
                ]
            ], 200);
        } else {
            return response()->json([
                'payment_provider' => [
                    'status' => 'error',
                    'error' => $result['message']
                ]
            ], 422);
        }
    }

    // Add Vehicle for Customer
    public function addVehicleApi(GeneralValidation $request)
    {
        $data = $request->all();
        $errorMsg = $request->newVehicleValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->iwashService->addVehicle($data);

        if ($result['success']) {
            return response()->json(['vehicle_information' => [
                'status' => 'success',
                'message' => 'Vehicle added successfully',
                'id' => $result['id'],
                'user_id' => $result['user_id'],
                'name' => $result['name'],
                'model_id' => $result['model_id'],
                'color_id' => $result['color_id'],
                'plate' => $result['plate'],
                'mfg' => $result['mfg'],
                'make_year' => $result['make_year'],
                'created_at' => $result['created_at'],
            ]], 201);
        } else {
            return response()->json(['vehicle_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }
}
