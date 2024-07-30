<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class RequestValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function UserRegistrationValidation($data)
    {

        $validator = Validator::make($data, [
            'first_name' => 'required|string|max:20|min:5',
            'last_name' => 'required|string|max:20|min:5',
            'username' => 'required|string|max:255|unique:tbl_users',
            'phone' => 'required|numeric|max:14|unique:tbl_users',
            'email' => 'required|string|max:50|unique:tbl_users',
            'password' => 'required|max:20|string',
            'role_id' => 'required|string|max:1',
        ], [
            'first_name.required' => 'Please Enter User First Name',
            'last_name.required' => 'Please Enter User Last Name',
            'username.required' => 'Please Enter User Username',
            'phone.required' => 'Please Enter User Phone',
            'email.required' => 'Please Enter User Email',
            'password.required' => 'Please Enter User Password',
            'role_id.required' => 'Please Enter User Role',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }

    public function UserLoginValidation($data)
    {
        $validator = Validator::make($data, [
            'username' => 'required|string|max:20|min:5',
            'password' => 'required|string|max:20|',
        ], [
            'username.required' => 'Username is required.',
            'password.required' => 'Password is required.',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        // return [
        //     'success' => true,
        //     'message' => 'Validation passed successfully'
        // ];
        return [];
    }

    public function UserUpdateValidation($data)
    {

        $validator = Validator::make($data, [
            'name' => 'required|string|max:20|min:5',
            'username' => 'required|string|max:255|',
            'phone' => 'required|numeric|max:14|',
            'email' => 'required|string|max:50|',
            'password' => 'required|max:20|string',
            'role_id' => 'required|string|max:1',
        ], [
            'name.required' => 'Please Enter User Name',
            'username.required' => 'Please Enter User Username',
            'phone.required' => 'Please Enter User Phone',
            'email.required' => 'Please Enter User Email',
            'password.required' => 'Please Enter User Password',
            'role_id.required' => 'Please Enter User Role',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }

}
