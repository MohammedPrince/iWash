<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    public function getUsers()
    {
        $users = User::where('status', 'active')->with('userRole')->get();

        if ($users->isNotEmpty()) {
            $user_array = [];
            foreach ($users as $user) {
                $user_array[] = [
                    'id' => $user->id,
                    'role_id' => $user->userRole->id,
                    'role_name' => $user->userRole->name,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'username' => $user->username,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'verified' => $user->verified,
                    'image_url' => $user->image_url,
                    'status' => $user->status,
                    'login_type' => $user->login_type,
                    'login_identity' => $user->login_identity,
                    'created_at' => $user->created_at,
                    'updated_at' => $user->updated_at,
                    'deleted_at' => $user->deleted_at
                ];
            }

            return ['success' => true, 'users' => $user_array];
        } else {
            return ['success' => false, 'message' => 'No Users Found.'];
        }
    }
    
    public function AddUser($data)
    {
        $users = User::where('username', $data['username'])->where('email', $data['email'])->where('status' ,'active')->get();

        if (count($users) == 0) {
            if ($user = User::create($data)) {
                $lastInsertedId = $user;

                $user = User::find($lastInsertedId);

                $token = $user->createToken('auth_token')->plainTextToken;

                return ['success' => true, 'role_id' => $user->role_id, 'first_name' => $user->first_name,'last_name' => $user->last_name,'username' => $user->username, 'token' => $token, 'token_type' => 'Bearer'];
            } else {
                return ['success' => false, 'message' => 'Error occurred while adding new user, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'User already exists!'];
        }
    }

    public function userLogin($data)
    {
        $authenticatedUser = User::where('username', $data['username'])
            ->where('verified', 'YES')
            ->where('status', 'active')
            ->first();

        if ($authenticatedUser && Hash::check($data['password'], $authenticatedUser->password)) {
            $token = $authenticatedUser->createToken('auth_token')->plainTextToken;

            return ['success' => true, 'role_id' => $authenticatedUser->role_id, 'first_name' => $authenticatedUser->first_name,'last_name' => $authenticatedUser->last_name, 'username' => $authenticatedUser->username,'token' => $token, 'token_type' => 'Bearer'];
        } else {
            return ['success' => false, 'message' => 'Invalid username or password.'];
        }
    }

    public function userLogout()
    {
        if (Auth::user()->tokens()->delete()) {
            return ['success' => true, 'message' => 'User logged out successfully.'];
        } else {
            return ['success' => false, 'message' => 'Error in logging out.'];
        }
    }

    public function GetUserById($id)
    {
        $id = base64_decode($id);
        if ($user = User::where('status', 'active')->find($id)) {
            return ['success' => true, 'role_id' => $user->role_id, 'first_name' => $user->first_name,'last_name' => $user->last_name, 'username' => $user->username,
                'phone' => $user->phone, 'email' => $user->email, 'verified' => $user->verified, 'image_url' => $user->image_url,
                'login_type' => $user->login_type, 'login_identity' => $user->login_identity, 'status' => $user->status,
                'created_at' => $user->created_at, 'updated_at' => $user->updated_at, 'deleted_at' => $user->deleted_at];
        } else {
            return ['success' => false, 'message' => 'Error occurred while getting user information'];
        }
    }

    public function UpdateUser($data, $id)
    {
        $id = base64_decode($id);
        $users = User::where('id', $id)->get();

        if (count($users) > 0) {
            $u = User::find($id);

            $u->role_id = $data['role_id'];
            $u->first_name = $data['first_name'];
            $u->last_name = $data['last_name'];
            $u->username = $data['username'];
            $u->phone = $data['phone'];
            $u->email = $data['email'];
            $u->password = $data['password'];

            if ($u->save()) {
                return ['success' => true, 'role_id' => $u->role_id, 'first_name' => $u->first_name,'last_name' => $u->last_name, 'username' => $u->username, 'phone' => $u->phone, 'email' => $u->email];
            } else {
                return ['success' => false, 'message' => 'Error occurred while updating user info, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'No user info exist for this ID, try again'];
        }
    }

    public function DeleteUser($id)
    {
        $id = base64_decode($id);
        $user = User::where('id', $id)->where('status' , 'active')->get();

        if (count($user) != 0) {
            $u = User::find($id);
            $u->status = 'deleted';
            if ($u->save()) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => ' Error While Deleting User, try again'];
            }
        }else{
            return ['success' => false, 'message' => ' User not exist or deleted.'];
        }
    }
}
