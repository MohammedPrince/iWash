<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralValidation;
use App\Services\IWashService;
use App\Services\RoleService;

class AdminController extends Controller
{
    protected $roleService;
    protected $iwashService;

    public function __construct(RoleService $roleService, IWashService $iwashService)
    {
        $this->roleService = $roleService;
        $this->iwashService = $iwashService;
    }

    // Manage Roles Start Here
    public function getRolesApi()
    {
        $result = $this->roleService->getRoles();

        if ($result['success']) {
            return response()->json([
                'roles' => [
                    'status' => 'success',
                    'message' => 'Roles Details',
                    'data' => $result['roles'],
                ]
            ], 200);
        } else {
            return response()->json([
                'roles' => [
                    'status' => 'error',
                    'error' => $result['message']
                ]
            ], 422);
        }
    }

    public function addRolesApi(GeneralValidation $request)
    {
        $data = $request->all();
        $errorMsg = $request->newRoleValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->roleService->addRoles($data);

        if ($result['success']) {
            return response()->json(['role_information' => [
                'status' => 'success',
                'message' => 'Role added successfully',
                'id' => $result['id'],
                'name' => $result['name'],
                'description' => $result['desc'],
                'status' => $result['status'],
                'created_at' => $result['created_at'],
            ]], 201);
        } else {
            return response()->json(['role_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }

    public function GetRoleByIdApi($id)
    {
        $result = $this->roleService->GetRoleById($id);

        if ($result['success']) {
            return response()->json(['role_information' => [
                'status' => 'success',
                'message' => 'Role Details',
                'id' => $result['id'],
                'name' => $result['name'],
                'description' => $result['desc'],
                'created_at' => $result['created_at'],
            ]], 200);
        } else {
            return response()->json(['role_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }

    public function UpdateRoleAPI(GeneralValidation $request, $id)
    {
        $data = $request->all();
        $errorMsg = $request->existRoleValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->roleService->updateRole($data, $id);

        if ($result['success']) {
            return response()->json(['role_information' => [
                'status' => 'success',
                'message' => 'Role updated successfully',
                'id' => $result['id'],
                'name' => $result['name'],
                'desc' => $result['desc'],
                'status' => $result['status'],
                'updated_at' => $result['updated_at'],
            ]], 201);
        } else {
            return response()->json(['role_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }

    public function DeleteRoleAPI($id)
    {
        $result = $this->roleService->DeleteRole($id);

        if ($result['success']) {
            return response()->json(['role_information' => [
                'status' => 'success',
                'message' => 'Role Deleted successfully',
            ]], 200);
        } else {
            return response()->json(['role_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }

    // Manage Roles End Here

    // Manage Iwash Services Start Here

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

    public function addServicesApi(GeneralValidation $request)
    {
        $data = $request->all();
        $errorMsg = $request->newServiceValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->iwashService->addService($data);

        if ($result['success']) {
            return response()->json(['service_information' => [
                'status' => 'success',
                'message' => 'Service added successfully',
                'id' => $result['id'],
                'name' => $result['name'],
                'description' => $result['desc'],
                'price' => $result['price'],
                'status' => $result['status'],
                'created_at' => $result['created_at'],
            ]], 201);
        } else {
            return response()->json(['service_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }

    public function GetServiceByIdApi($id)
    {
        $result = $this->iwashService->GetServiceById($id);

        if ($result['success']) {
            return response()->json(['service_information' => [
                'status' => 'success',
                'message' => 'Service Details',
                'id' => $result['id'],
                'name' => $result['name'],
                'description' => $result['desc'],
                'price' => $result['price'],
                'created_at' => $result['created_at'],
            ]], 200);
        } else {
            return response()->json(['service_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }

    public function UpdateServiceAPI(GeneralValidation $request, $id)
    {
        $data = $request->all();
        $errorMsg = $request->existServiceValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->iwashService->UpdateService($data, $id);

        if ($result['success']) {
            return response()->json(['service_information' => [
                'status' => 'success',
                'message' => 'Service updated successfully',
                'id' => $result['id'],
                'name' => $result['name'],
                'description' => $result['desc'],
                'price' => $result['price'],
                'status' => $result['status'],
                'updated_at' => $result['updated_at'],
            ]], 201);
        } else {
            return response()->json(['service_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }

    public function DeleteServiceAPI($id)
    {
        $result = $this->iwashService->DeleteService($id);

        if ($result['success']) {
            return response()->json(['service_information' => [
                'status' => 'success',
                'message' => 'Service Deleted successfully',
            ]], 200);
        } else {
            return response()->json(['service_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }

    // Manage Iwash Services End Here

    // // Manage Listing  -- Like Car Colors,Car Models,Offers

    // Manage Car Colors Start Here
    public function addCarColorApi(GeneralValidation $request)
    {
        $data = $request->all();
        $errorMsg = $request->newCarColorValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->iwashService->addCarColors($data);

        if ($result['success']) {
            return response()->json(['color_information' => [
                'status' => 'success',
                'message' => 'Color added successfully',
                'id' => $result['id'],
                'name' => $result['name'],
                'status' => $result['status'],
                'created_at' => $result['created_at'],
            ]], 201);
        } else {
            return response()->json(['service_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }

    public function GetCarColorByIdApi($id)
    {
        $result = $this->iwashService->GetColorById($id);

        if ($result['success']) {
            return response()->json(['color_information' => [
                'status' => 'success',
                'message' => 'Color Details',
                'id' => $result['id'],
                'name' => $result['name'],
                'created_at' => $result['created_at'],
            ]], 200);
        } else {
            return response()->json(['color_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }

    public function UpdateCarColorAPI(GeneralValidation $request, $id)
    {
        $data = $request->all();
        $errorMsg = $request->existCarColorValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->iwashService->UpdateCarColor($data, $id);

        if ($result['success']) {
            return response()->json(['color_information' => [
                'status' => 'success',
                'message' => 'Color updated successfully',
                'id' => $result['id'],
                'name' => $result['name'],
                'updated_at' => $result['updated_at'],
            ]], 201);
        } else {
            return response()->json(['color_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }

    public function DeleteColorAPI($id)
    {
        $result = $this->iwashService->DeleteCarColor($id);

        if ($result['success']) {
            return response()->json(['color_information' => [
                'status' => 'success',
                'message' => 'Color Deleted successfully',
            ]], 200);
        } else {
            return response()->json(['color_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }

    // Manage Car Colors End Here

    // Manage Car Models Start Here
    public function addCarModelApi(GeneralValidation $request)
    {
        $data = $request->all();
        $errorMsg = $request->newCarModelValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->iwashService->addCarModel($data);

        if ($result['success']) {
            return response()->json(['model_information' => [
                'status' => 'success',
                'message' => 'Color added successfully',
                'id' => $result['id'],
                'name' => $result['name'],
                'desc' => $result['desc'],
                'image_url' => $result['image_url'],
                'status' => $result['status'],
                'created_at' => $result['created_at'],
            ]], 201);
        } else {
            return response()->json(['model_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }

    public function GetCarModelByIdApi($id)
    {
        $result = $this->iwashService->GetCarModelById($id);

        if ($result['success']) {
            return response()->json(['model_information' => [
                'status' => 'success',
                'message' => 'Model Details',
                'id' => $result['id'],
                'name' => $result['name'],
                'desc' => $result['desc'],
                'created_at' => $result['created_at'],
            ]], 200);
        } else {
            return response()->json(['model_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }

    public function UpdateCarModelAPI(GeneralValidation $request, $id)
    {
        $data = $request->all();
        $errorMsg = $request->updateCarModelValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->iwashService->UpdateCarModel($data, $id);

        if ($result['success']) {
            return response()->json(['model_information' => [
                'status' => 'success',
                'message' => 'Model updated successfully',
                'id' => $result['id'],
                'name' => $result['name'],
                'desc' => $result['desc'],
                'updated_at' => $result['updated_at'],
            ]], 201);
        } else {
            return response()->json(['model_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }

    public function DeleteModelAPI($id)
    {
        $result = $this->iwashService->DeleteCarModel($id);

        if ($result['success']) {
            return response()->json(['model_information' => [
                'status' => 'success',
                'message' => 'Model Deleted successfully',
            ]], 200);
        } else {
            return response()->json(['model_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }
    // Manage Car Models End Here

    // Manage iWash Offers Start Here
    public function addOfferApi(GeneralValidation $request)
    {
        $data = $request->all();
        $errorMsg = $request->newOfferValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->iwashService->addOffer($data);

        if ($result['success']) {
            return response()->json(['offer_information' => [
                'status' => 'success',
                'message' => 'Offer added successfully',
                'id' => $result['id'],
                'name' => $result['name'],
                'desc' => $result['desc'],
                'discount' => $result['discount'],
                'status' => $result['status'],
                'created_at' => $result['created_at'],
            ]], 201);
        } else {
            return response()->json(['offer_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }

    public function GetOfferByIdApi($id)
    {
        $result = $this->iwashService->GetOfferById($id);

        if ($result['success']) {
            return response()->json(['offer_information' => [
                'status' => 'success',
                'message' => 'Offer Details',
                'id' => $result['id'],
                'name' => $result['name'],
                'service_name' => $result['service_name'],
                'desc' => $result['desc'],
                'discount' => $result['discount'],
                'created_at' => $result['created_at'],
            ]], 200);
        } else {
            return response()->json(['offer_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }

    public function UpdateOfferAPI(GeneralValidation $request, $id)
    {
        $data = $request->all();
        $errorMsg = $request->updateOfferValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->iwashService->UpdateOffer($data, $id);

        if ($result['success']) {
            return response()->json(['offer_information' => [
                'status' => 'success',
                'message' => 'Offer updated successfully',
                'id' => $result['id'],
                'name' => $result['name'],
                'service_name' => $result['service_name'],
                'desc' => $result['desc'],
                'discount' => $result['discount'],
                'updated_at' => $result['updated_at'],
            ]], 201);
        } else {
            return response()->json(['offer_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }

    public function DeleteOfferAPI($id)
    {
        $result = $this->iwashService->DeleteOffer($id);

        if ($result['success']) {
            return response()->json(['offer_information' => [
                'status' => 'success',
                'message' => 'Offer Deleted successfully',
            ]], 200);
        } else {
            return response()->json(['offer_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }

    // Manage iWash Offers End Here

    // Manage iWash Payment Provider Start Here
    public function addPaymentProviderApi(GeneralValidation $request)
    {
        $data = $request->all();
        $errorMsg = $request->newPaymentProviderValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->iwashService->addPaymentProvider($data);

        if ($result['success']) {
            return response()->json(['payment_provider_information' => [
                'status' => 'success',
                'message' => 'Payment Provider added successfully',
                'id' => $result['id'],
                'name' => $result['name'],
                'desc' => $result['desc'],
                'status' => $result['status'],
                'created_at' => $result['created_at'],
            ]], 201);
        } else {
            return response()->json(['payment_provider_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }

    public function GetPaymentPByIdApi($id)
    {
        $result = $this->iwashService->GetPaymentPById($id);

        if ($result['success']) {
            return response()->json(['payment_provider_information' => [
                'status' => 'success',
                'message' => 'Payment Provider Details',
                'id' => $result['id'],
                'name' => $result['name'],
                'desc' => $result['desc'],
                'status' => $result['status'],
                'created_at' => $result['created_at'],
            ]], 200);
        } else {
            return response()->json(['payment_provider_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }

    public function UpdatePaymentPAPI(GeneralValidation $request, $id)
    {
        $data = $request->all();
        $errorMsg = $request->updatePaymentProviderValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->iwashService->UpdatePaymentProvider($data, $id);

        if ($result['success']) {
            return response()->json(['payment_provider_information' => [
                'status' => 'success',
                'message' => 'Payment provider updated successfully',
                'id' => $result['id'],
                'name' => $result['name'],
                'desc' => $result['desc'],
                'created_at' => $result['created_at'],
                'updated_at' => $result['updated_at'],
            ]], 201);
        } else {
            return response()->json(['payment_provider_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }

    public function DeletePaymentPAPI($id)
    {
        $result = $this->iwashService->DeletePaymentProvider($id);

        if ($result['success']) {
            return response()->json(['payment_provider_information' => [
                'status' => 'success',
                'message' => 'Payment Provider Deleted successfully',
            ]], 200);
        } else {
            return response()->json(['payment_provider_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }


    // Manage iWash Payment Provider End Here
}
