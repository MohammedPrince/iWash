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

    public function UpdateService($data, $id)
    {
        return $this->serviceRepository->UpdateService($data, $id);
    }

    public function DeleteService($id)
    {
        return $this->serviceRepository->DeleteService($id);
    }

    public function addOffer($data)
    {
        return $this->serviceRepository->addOffer($data);
    }

    public function getOffers()
    {
        return $this->serviceRepository->getOffers();
    }

    public function GetOfferById($id)
    {
        return $this->serviceRepository->GetOfferById($id);
    }

    public function UpdateOffer($data,$id)
    {
        return $this->serviceRepository->UpdateOffer($data,$id);
    }

    public function DeleteOffer($id)
    {
        return $this->serviceRepository->DeleteOffer($id);
    }

    public function addCarColors($data)
    {
        return $this->serviceRepository->addCarColors($data);
    }

    public function getCarColors()
    {
        return $this->serviceRepository->getCarColors();
    }

    public function GetColorById($id)
    {
        return $this->serviceRepository->GetColorById($id);
    }

    public function UpdateCarColor($data, $id)
    {
        return $this->serviceRepository->UpdateCarColor($data, $id);
    }

    public function DeleteCarColor($id)
    {
        return $this->serviceRepository->DeleteCarColor($id);
    }

    public function addCarModel($data)
    {
        return $this->serviceRepository->addCarModel($data);
    }

    public function getCarModels()
    {
        return $this->serviceRepository->getCarModels();
    }

    public function GetCarModelById($id)
    {
        return $this->serviceRepository->GetCarModelById($id);
    }

    public function UpdateCarModel($data, $id)
    {
        return $this->serviceRepository->UpdateCarModel($data, $id);
    }

    public function DeleteCarModel($id)
    {
        return $this->serviceRepository->DeleteCarModel($id);
    }

    public function addVehicle($data)
    {
        return $this->serviceRepository->addVehicle($data);
    }

    public function addPaymentProvider($data)
    {
        return $this->serviceRepository->addPaymentProvider($data);
    }

    public function getPaymentProvider()
    {
        return $this->serviceRepository->getPaymentProvider();
    }
    public function GetPaymentPById($id)
    {
        return $this->serviceRepository->GetPaymentPById($id);
    }

    public function UpdatePaymentProvider($data, $id)
    {
        return $this->serviceRepository->UpdatePaymentProvider($data, $id);
    }

    public function DeletePaymentProvider($id)
    {
        return $this->serviceRepository->DeletePaymentProvider($id);
    }

}
