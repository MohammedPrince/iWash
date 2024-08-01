<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class MyUserRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return User::class;
    }

    public function getContacts()
    {
        return User::where('del', 0)->orderBy('id', 'desc')->paginate(10);
    }

    public function AddUser($data)
    {
        $users = User::where('username', $data['username'])->where('email', $data['email'])->get();

        if (count($users) == 0) {
            if ($user = User::create($data)) {
                $lastInsertedId = $user;

                $user = User::find($lastInsertedId);

                $token = $user->createToken('auth_token')->plainTextToken;

                return ['success' => true, 'role_id' => $user->role_id, 'name' => $user->name, 'token' => $token, 'token_type' => 'Bearer'];
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

            return ['success' => true, 'role_id' => $authenticatedUser->role_id, 'name' => $authenticatedUser->name, 'token' => $token, 'token_type' => 'Bearer'];
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
        if ($user = User::where('status', 'active')->find($id)) {
            return ['success' => true, 'role_id' => $user->role_id, 'name' => $user->name, 'username' => $user->username,
                'phone' => $user->phone, 'email' => $user->email, 'verified' => $user->verified, 'image_url' => $user->image_url,
                'login_type' => $user->login_type, 'login_identity' => $user->login_identity, 'status' => $user->status,
                'created_at' => $user->created_at, 'updated_at' => $user->updated_at, 'deleted_at' => $user->deleted_at];
        } else {
            return ['success' => false, 'message' => 'Error occurred while getting user information'];
        }
    }

    public function UpdateUser($data, $id)
    {
        $users = User::where('id', $id)->get();

        if (count($users) > 0) {
            $u = User::find($id);

            $u->role_id = $data['role_id'];
            $u->name = $data['name'];
            $u->phone = $data['phone'];
            $u->email = $data['email'];
            $u->password = $data['password'];

            if ($u->save()) {
                return ['success' => true, 'role_id' => $u->role_id, 'name' => $u->name, 'username' => $u->username, 'phone' => $u->phone, 'email' => $u->email];
            } else {
                return ['success' => false, 'message' => 'Error occurred while updating user info, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'No user info exist for this ID, try again'];
        }
    }

    public function DeleteUser($id)
    {
        $user = User::where('id', $id)->get();

        if (count($user) != 0) {
            $u = User::find($id);
            $u->status = 'deleted';
            if ($u->save()) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => ' Error While Deleting User, try again'];
            }
        }
    }
}
