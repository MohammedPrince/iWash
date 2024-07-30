<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers()
    {
        return $this->userRepository->getUsers();
    }

    public function addUser($data)
    {
        return $this->userRepository->addUser($data);
    }

    public function userLogin($data)
    {
        return $this->userRepository->userLogin($data);
    }

    public function userLogout()
    {
        return $this->userRepository->userLogout();
    }

    public function GetUserById($id)
    {
        return $this->userRepository->GetUserById($id);
    }

    public function UpdateUser($data ,$id)
    {
        return $this->userRepository->UpdateUser($data ,$id);
    }

    public function DeleteUser($id)
    {
        return $this->userRepository->DeleteUser($id);
    }

    
}
