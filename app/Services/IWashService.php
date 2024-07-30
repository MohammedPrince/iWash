<?php

namespace App\Services;

use App\Repositories\ServiceRepository;

class IWashService
{
    protected $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    public function getServices()
    {
        return $this->serviceRepository->getServices();
    }

    public function addService($data)
    {
        return $this->serviceRepository->addService($data);
    }

    public function GetServiceById($id)
    {
        return $this->serviceRepository->GetServiceById($id);
    }

    public function UpdateService($data ,$id)
    {
        return $this->serviceRepository->UpdateService($data ,$id);
    }

    public function DeleteService($id)
    {
        return $this->serviceRepository->DeleteService($id);
    }

    public function getOffers()
    {
        return $this->serviceRepository->getOffers();
    }

    public function getCarColors()
    {
        return $this->serviceRepository->getCarColors();
    }

    public function getCarModels()
    {
        return $this->serviceRepository->getCarModels();
    }

    public function addVehicle($data)
    {
        return $this->serviceRepository->addVehicle($data);
    }

}
