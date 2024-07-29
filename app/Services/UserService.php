<?php

namespace App\Services;

use App\Repositories\MyUserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(MyUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getContacts()
    {
        return $this->userRepository->getContacts();
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
