<?php

namespace App\Repositories;

use App\Models\Colors;
use App\Models\IwashService;
use App\Models\Offers;
use App\Models\Vehicle_Models;
use App\Models\Vehicles;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;

class ServiceRepository extends BaseRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return IwashService::class;
    }

    public function getServices()
    {
        $services = IwashService::where('status', 'active')->get();

        if ($services->isNotEmpty()) {
            $iwashservices = [];
            foreach ($services as $service) {
                $iwashservices[] = [
                    'id' => $service->id,
                    'name' => $service->name,
                    'desc' => $service->desc,
                    'price' => $service->price,
                    'status' => $service->status,
                    'created_at' => $service->created_at,
                    'updated_at' => $service->updated_at,
                    'deleted_at' => $service->deleted_at
                ];
            }
            return ['success' => true, 'services' => $iwashservices];
        } else {
            return ['success' => false, 'message' => 'No Services Found.'];
        }
    }

    public function addService($data)
    {
        $services = IwashService::where('name', $data['name'])->where('status', 'active')->get();

        if (count($services) == 0) {
            if ($service = IwashService::create($data)) {
                $lastInsertedId = $service;

                $service = IwashService::find($lastInsertedId);

                return ['success' => true, 'id' => $service->id, 'name' => $service->name, 'desc' => $service->desc, 'status' => $service->status, 'price' => $service->price,
                    'created_at' => $service->created_at, 'updated_at' => $service->updated_at];
            } else {
                return ['success' => false, 'message' => 'Error occurred while adding new service, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'Service already exists!'];
        }
    }

    public function GetServiceById($id)
    {
        $id = base64_decode($id);
        if ($service = IwashService::where('status', 'active')->find($id)) {
            return ['success' => true, 'id' => $service->id, 'name' => $service->name, 'desc' => $service->desc, 'status' => $service->status, 'price' => $service->price,
                'created_at' => $service->created_at, 'updated_at' => $service->updated_at];
        } else {
            return ['success' => false, 'message' => 'Error occurred while getting service information'];
        }
    }

    public function UpdateService($data, $id)
    {
        $id = base64_decode($id);
        $service = IwashService::where('id', $id)->where('status', 'active')->get();

        if (count($service) > 0) {
            $s = IwashService::find($id);

            $s->name = $data['name'];
            $s->desc = $data['desc'];
            $s->status = $data['status'];
            $s->price = $data['price'];
            $s->updated_at = now();

            if ($s->save()) {
                return ['success' => true, 'id' => $s->id, 'name' => $s->name, 'desc' => $s->desc, 'status' => $s->status, 'price' => $s->price, 'updated_at' => $s->updated_at];
            } else {
                return ['success' => false, 'message' => 'Error occurred while updating service info, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'No service info exist for this ID, try again'];
        }
    }

    public function DeleteService($id)
    {
        $id = base64_decode($id);
        $service = IwashService::where('id', $id)->where('status', 'active')->get();

        if (count($service) != 0) {
            $s = IwashService::find($id);
            $s->status = 'deleted';
            if ($s->save()) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Error While Deleting Service, try again'];
            }
        } else {
            return ['success' => false, 'message' => 'Service not exist or deleted.'];
        }
    }

    public function getOffers()
    {
        $offers = Offers::where('status', 'active')->with('forService')->get();

        if ($offers->isNotEmpty()) {
            $iwashOffers = [];
            foreach ($offers as $offer) {
                $iwashOffers[] = [
                    'id' => $offer->id,
                    'name' => $offer->name,
                    'desc' => $offer->desc,
                    'service_name' => $offer->forService->name,
                    'discount' => $offer->discount,
                    'status' => $offer->status,
                    'created_at' => $offer->created_at,
                    'updated_at' => $offer->updated_at,
                    'deleted_at' => $offer->deleted_at
                ];
            }
            return ['success' => true, 'offers' => $iwashOffers];
        } else {
            return ['success' => false, 'message' => 'No Offers Found.'];
        }
    }

    public function getCarColors()
    {
        $colors = Colors::where('status', 'active')->get();

        if ($colors->isNotEmpty()) {
            $carColors = [];
            foreach ($colors as $color) {
                $carColors[] = [
                    'id' => $color->id,
                    'name' => $color->name,
                    'status' => $color->status,
                    'created_at' => $color->created_at,
                    'updated_at' => $color->updated_at,
                    'deleted_at' => $color->deleted_at
                ];
            }
            return ['success' => true, 'colors' => $carColors];
        } else {
            return ['success' => false, 'message' => 'No Colors Found.'];
        }
    }

    public function getCarModels()
    {
        $v_models = Vehicle_Models::where('status', 'active')->get();

        if ($v_models->isNotEmpty()) {
            $vehicle_models = [];
            foreach ($v_models as $v_model) {
                $vehicle_models[] = [
                    'id' => $v_model->id,
                    'name' => $v_model->name,
                    'desc' => $v_model->desc,
                    'image_url' => $v_model->image_url,
                    'status' => $v_model->status,
                    'created_at' => $v_model->created_at,
                    'updated_at' => $v_model->updated_at,
                    'deleted_at' => $v_model->deleted_at
                ];
            }
            return ['success' => true, 'vehicle_models' => $vehicle_models];
        } else {
            return ['success' => false, 'message' => 'No Models Found.'];
        }
    }

    public function addVehicle($data)
    {
        $vehicles = Vehicles::where('name', $data['name'])->where('status', 'active')->get();

        if (count($vehicles) == 0) {
            if ($vehicle = Vehicles::create($data)) {
                $lastInsertedId = $vehicle;

                $vehicle = Vehicles::find($lastInsertedId);

                return ['success' => true, 'id' => $vehicle->id, 'user_id' => $vehicle->user_id, 'name' => $vehicle->name, 'model_id' => $vehicle->model_id,
                    'color_id' => $vehicle->color_id, 'plate' => $vehicle->plate, 'mfg' => $vehicle->mfg , 'make_year' => $vehicle->make_year , 'created_at' => $vehicle->created_at ];
            } else {
                return ['success' => false, 'message' => 'Error occurred while adding new vehicle, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'Vehicle already exists!'];
        }
    }
}
