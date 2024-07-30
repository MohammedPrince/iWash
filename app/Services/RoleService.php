<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function getRoles()
    {
        return $this->roleRepository->getRoles();
    }

    public function addRoles($data)
    {
        return $this->roleRepository->addRoles($data);
    }

    public function GetRoleById($id)
    {
        return $this->roleRepository->GetRoleById($id);
    }

    public function UpdateRole($data, $id)
    {
        return $this->roleRepository->UpdateRole($data, $id);
    }

    public function DeleteRole($id)
    {
        return $this->roleRepository->DeleteRole($id);
    }
}
