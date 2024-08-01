<?php

namespace App\Repositories;

use App\Models\UserRole;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class RoleRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return UserRole::class;
    }

    public function getRoles()
    {
        $user_roles = UserRole::where('status', 'active')->get();

        if ($user_roles->isNotEmpty()) {
            $roles = [];
            foreach ($user_roles as $user_role) {
                $roles[] = [
                    'role_id' => $user_role->id,
                    'name' => $user_role->name,
                    'desc' => $user_role->desc,
                    'status' => $user_role->status,
                    'created_at' => $user_role->created_at,
                    'updated_at' => $user_role->updated_at,
                ];
            }
            return ['success' => true, 'roles' => $roles];
        } else {
            return ['success' => false, 'message' => 'No Roles Found.'];
        }
    }

    public function addRoles($data)
    {
        $roles = UserRole::where('name', $data['name'])->where('status', 'active')->get();

        if (count($roles) == 0) {
            if ($role = UserRole::create($data)) {
                $lastInsertedId = $role;

                $role = UserRole::find($lastInsertedId);

                return ['success' => true, 'id' => $role->id, 'name' => $role->name, 'desc' => $role->desc, 'status' => $role->status,
                    'created_at' => $role->created_at, 'updated_at' => $role->updated_at];
            } else {
                return ['success' => false, 'message' => 'Error occurred while adding new role, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'Role already exists!'];
        }
    }

    public function GetRoleById($id)
    {
        $id = base64_decode($id);
        if ($role = UserRole::where('status', 'active')->find($id)) {
            return ['success' => true, 'id' => $role->id, 'name' => $role->name, 'desc' => $role->desc, 'status' => $role->status,
                'created_at' => $role->created_at, 'updated_at' => $role->updated_at];
        } else {
            return ['success' => false, 'message' => 'Error occurred while getting role information'];
        }
    }

    public function UpdateRole($data, $id)
    {
        $id = base64_decode($id);
        $roles = UserRole::where('id', $id)->where('status', 'active')->get();

        if (count($roles) > 0) {
            $r = UserRole::find($id);

            $r->name = $data['name'];
            $r->desc = $data['desc'];
            $r->status = $data['status'];
            $r->updated_at = now();

            if ($r->save()) {
                return ['success' => true, 'id' => $r->id, 'name' => $r->name, 'desc' => $r->desc, 'status' => $r->status, 'updated_at' => $r->updated_at];
            } else {
                return ['success' => false, 'message' => 'Error occurred while updating role info, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'No role info exist for this ID, try again'];
        }
    }

    public function DeleteRole($id)
    {
        $id = base64_decode($id);
        $role = UserRole::where('id', $id)->where('status', 'active')->get();

        if (count($role) != 0) {
            $r = UserRole::find($id);
            $r->status = 'deleted';
            $r->deleted_at = now();
            if ($r->save()) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Error While Deleting Role, try again'];
            }
        } else {
            return ['success' => false, 'message' => 'Role not exist or deleted.'];
        }
    }
}
