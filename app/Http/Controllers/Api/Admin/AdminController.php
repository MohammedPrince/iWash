<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralValidation;
use App\Services\RoleService;
use App\Services\IWashService;

class AdminController extends Controller
{
    protected $roleService;
    protected $iwashService;

    public function __construct(RoleService $roleService , IWashService $iwashService)
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
                'updated_at' => $result['updated_at'],
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
                'updated_at' => $result['updated_at'],
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
                'updated_at' => $result['updated_at'],
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
                'updated_at' => $result['updated_at'],
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
}
