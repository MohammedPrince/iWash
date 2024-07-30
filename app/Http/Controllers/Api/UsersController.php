<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestValidation;
use App\Services\UserService;
use Illuminate\Http\Request;


class UsersController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUsersApi()
    {
        $result = $this->userService->getUsers();

        if ($result['success']) {
            return response()->json([
                'users' => [
                    'status' => 'success',
                    'message' => 'Users Details',
                    'data' => $result['users'],
                ]
            ], 200);
        } else {
            return response()->json([
                'users' => [
                    'status' => 'error',
                    'error' => $result['message']
                ]
            ], 422);
        }
    }

    public function addUserApi(RequestValidation $request)
    {
        $data = $request->all();
        $errorMsg = $request->UserRegistrationValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->userService->addUser($data);

        if ($result['success']) {
            return response()->json(['user_information' => [
                'status' => 'success',
                'message' => 'User added successfully',
                'role_id' => $result['role_id'],
                'first_name' => $result['first_name'],
                'last_name' => $result['last_name'],
                'username' => $result['username'],
                'token' => $result['token'],
                'token_type' => $result['token_type']
            ]], 201);
        } else {
            return response()->json(['user_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }

    public function userLoginApi(RequestValidation $request)
    {
        $data = $request->all();
        $errorMsg = $request->UserLoginValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->userService->userLogin($data);

        if ($result['success']) {
            return response()->json(['user_information' => [
                'status' => 'success',
                'message' => 'User logged in successfully',
                'role_id' => $result['role_id'],
                'first_name' => $result['first_name'],
                'last_name' => $result['last_name'],
                'username' => $result['username'],
                'token' => $result['token'],
                'token_type' => $result['token_type']
            ]], 200);
        } else {
            return response()->json(['user_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }

    public function userLogoutApi(Request $request)
    {
        $result = $this->userService->userLogout();

        if ($result['success']) {
            return response()->json(['user_information' => ['status' => 'success', 'message' => 'User logged out successfully']], 200);
        } else {
            return response()->json(['user_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }

    public function GetUserByIdApi($id)
    {
        $result = $this->userService->GetUserById($id);

        if ($result['success']) {
            return response()->json(['user_information' => [
                'status' => 'success',
                'message' => 'User Details',
                'role_id' => $result['role_id'],
                'username' => $result['username'],
                'first_name' => $result['first_name'],
                'last_name' => $result['last_name'],
                'phone' => $result['phone'],
                'email' => $result['email'],
                'image_url' => $result['image_url'],
                'login_type' => $result['login_type'],
                'login_identity' => $result['login_identity'],
                'status' => $result['status'],
                'created_at' => $result['created_at'],
                'updated_at' => $result['updated_at'],
                'deleted_at' => $result['deleted_at'],
            ]], 200);
        } else {
            return response()->json(['user_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }

    public function UpdateUserAPI(RequestValidation $request, $id)
    {
        $data = $request->all();
        $errorMsg = $request->UserUpdateValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->userService->UpdateUser($data,$id);

        if ($result['success']) {
            return response()->json(['user_information' => [
                'status' => 'success',
                'message' => 'User Info Updated successfully',
                'role_id' => $result['role_id'],
                'first_name' => $result['first_name'],
                'last_name' => $result['last_name'],
                'username' => $result['username'],
                'phone' => $result['phone'],
                'email' => $result['email']
            ]], 201);
        } else {
            return response()->json(['user_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
    }

    public function DeleteUserAPI($id)
    {
        $result = $this->userService->DeleteUser($id);

        if ($result['success']) {
            return response()->json(['user_information' => [
                'status' => 'success',
                'message' => 'User Deleted successfully',
            ]], 200);
        } else {
            return response()->json(['user_information' => ['status' => 'error', 'Error' => $result['message']]], 422);
        }
    }
}
