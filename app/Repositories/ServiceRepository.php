<?php

namespace App\Repositories;

use App\Models\Colors;
use App\Models\IwashService;
use App\Models\Offers;
use App\Models\Payment_Provider;
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
            $s->deleted_at = now();
            if ($s->save()) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Error While Deleting Service, try again'];
            }
        } else {
            return ['success' => false, 'message' => 'Service not exist or deleted.'];
        }
    }

    public function addOffer($data)
    {
        $offers = Offers::where('name', $data['name'])->where('status', 'active')->where('service_id' , $data['service_id'])->get();

        if (count($offers) == 0) {
            if ($offer = Offers::create($data)) {
                $lastInsertedId = $offer;

                $offer = Offers::find($lastInsertedId);

        return ['success' => true, 'id' => $offer->id, 'name' => $offer->name, 'desc' => $offer->desc, 'discount' => $offer->discount, 'status' => $offer->status,'created_at' => $offer->created_at ];
            } else {
                return ['success' => false, 'message' => 'Error occurred while adding new offer, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'Offer already exists for this service'];
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
                ];
            }
            return ['success' => true, 'offers' => $iwashOffers];
        } else {
            return ['success' => false, 'message' => 'No Offers Found.'];
        }
    }

    public function GetOfferById($id)
    {
        $id = base64_decode($id);
        if ($offer = Offers::where('status', 'active')->with('forService')->find($id)) {

    return ['success' => true, 'id' => $offer->id, 'name' => $offer->name, 'service_name' => $offer->forService->name,  'desc' => $offer->desc, 'status' => $offer->status, 'discount' => $offer->discount,
                'created_at' => $offer->created_at, 'updated_at' => $offer->updated_at];
        } else {
            return ['success' => false, 'message' => 'Error occurred while getting offer information'];
        }
    }

    public function UpdateOffer($data, $id)
    {
        $id = base64_decode($id);
        $offer = Offers::where('id', $id)->where('status', 'active')->with('forService')->get();

        if (count($offer) > 0) {
            $o = Offers::find($id);

            $o->service_id = $data['service_id'];
            $o->name = $data['name'];
            $o->desc = $data['desc'];
            $o->discount = $data['discount'];
            $o->updated_at = now();

            if ($o->save()) {
                return ['success' => true, 'id' => $o->id, 'name' => $o->name, 'service_name' => $o->forService->name, 'desc' => $o->desc, 'status' => $o->status, 'discount' => $o->discount, 'updated_at' => $o->updated_at];
            } else {
                return ['success' => false, 'message' => 'Error occurred while updating offer info, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'No offer info exist for this ID, try again'];
        }
    }

    public function DeleteOffer($id)
    {
        //$id = base64_decode($id);
        $offer = Offers::where('id', $id)->where('status', 'active')->get();

        if (count($offer) != 0) {
            $o = Offers::find($id);
            $o->status = 'deleted';
            $o->deleted_at = now();
            if ($o->save()) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Error While Deleting Offer, try again'];
            }
        } else {
            return ['success' => false, 'message' => 'Offer not exist or deleted.'];
        }
    }

    public function addCarColors($data)
    {
        $colors = Colors::where('name', $data['name'])->where('status', 'active')->get();

        if (count($colors) == 0) {
            if ($colors = Colors::create($data)) {
                $lastInsertedId = $colors;

                $color = Colors::find($lastInsertedId);

                return ['success' => true, 'id' => $color->id, 'name' => $color->name, 'status' => $color->status,'created_at' => $color->created_at];
            } else {
                return ['success' => false, 'message' => 'Error occurred while adding new color, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'Color already exists!'];
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
        
                ];
            }
            return ['success' => true, 'colors' => $carColors];
        } else {
            return ['success' => false, 'message' => 'No Colors Found.'];
        }
    }

    public function GetColorById($id)
    {
        $id = base64_decode($id);
        if ($color = Colors::where('status', 'active')->find($id)) {
            return ['success' => true, 'id' => $color->id, 'name' => $color->name, 'status' => $color->status, 'created_at' => $color->created_at];
        } else {
            return ['success' => false, 'message' => 'Error occurred while getting color information'];
        }
    }

    public function UpdateCarColor($data, $id)
    {
        $id = base64_decode($id);
        $color = Colors::where('id', $id)->where('status', 'active')->get();

        if (count($color) > 0) {
            $c = Colors::find($id);

            $c->name = $data['name'];
            $c->updated_at = now();

            if ($c->save()) {
                return ['success' => true, 'id' => $c->id, 'name' => $c->name, 'updated_at' => $c->updated_at];
            } else {
                return ['success' => false, 'message' => 'Error occurred while updating color info, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'No color info exist for this ID, try again'];
        }
    }

    public function DeleteCarColor($id)
    {
        $id = base64_decode($id);
        $color = Colors::where('id', $id)->where('status', 'active')->get();

        if (count($color) != 0) {
            $c = Colors::find($id);

            $c->status = 'deleted';
            $c->deleted_at = now();
            
            if ($c->save()) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Error While Deleting Color, try again'];
            }
        } else {
            return ['success' => false, 'message' => 'Color not exist or deleted.'];
        }
    }

    public function addCarModel($data)
    {
        $models = Vehicle_Models::where('name', $data['name'])->where('status', 'active')->get();

        if (count($models) == 0) {
            if ($models = Vehicle_Models::create($data)) {
                $lastInsertedId = $models;

                $model = Vehicle_Models::find($lastInsertedId);

            return ['success' => true, 'id' => $model->id, 'name' => $model->name, 'desc' => $model->desc, 'image_url' => $model->image_url,
            'status' => $model->status,'created_at' => $model->created_at];
            
            } else {
                return ['success' => false, 'message' => 'Error occurred while adding new model, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'Model already exists!'];
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
                ];
            }
            return ['success' => true, 'vehicle_models' => $vehicle_models];
        } else {
            return ['success' => false, 'message' => 'No Models Found.'];
        }
    }

    public function GetCarModelById($id)
    {
        $id = base64_decode($id);
        if ($model = Vehicle_Models::where('status', 'active')->find($id)) {
            return ['success' => true, 'id' => $model->id, 'name' => $model->name, 'desc' => $model->desc,'status' => $model->status, 'created_at' => $model->created_at];
        } else {
            return ['success' => false, 'message' => 'Error occurred while getting model information'];
        }
    }


    public function UpdateCarModel($data, $id)
    {
        $id = base64_decode($id);
        $Vehicle_Model = Vehicle_Models::where('id', $id)->where('status', 'active')->get();

        if (count($Vehicle_Model) > 0) {
            $m = Vehicle_Models::find($id);

            $m->name = $data['name'];
            $m->desc = $data['desc'];

            $m->updated_at = now();

            if ($m->save()) {
                return ['success' => true, 'id' => $m->id, 'name' => $m->name, 'desc' => $m->desc, 'updated_at' => $m->updated_at];
            } else {
                return ['success' => false, 'message' => 'Error occurred while updating model info, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'No model info exist for this ID, try again'];
        }
    }

    public function DeleteCarModel($id)
    {
        $id = base64_decode($id);
        $model = Vehicle_Models::where('id', $id)->where('status', 'active')->get();

        if (count($model) != 0) {
            $m = Vehicle_Models::find($id);

            $m->status = 'deleted';
            $m->deleted_at = now();
            
            if ($m->save()) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Error While Deleting Model, try again'];
            }
        } else {
            return ['success' => false, 'message' => 'Model not exist or deleted.'];
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

    public function addPaymentProvider($data)
    {
        $payment_provider = Payment_Provider::where('name', $data['name'])->where('status', 'active')->get();

        if (count($payment_provider) == 0) {
            if ($payment_p = Payment_Provider::create($data)) {
                $lastInsertedId = $payment_p;

                $payment_p = Payment_Provider::find($lastInsertedId);

                return ['success' => true, 'id' => $payment_p->id, 'name' => $payment_p->name, 'desc' => $payment_p->desc, 'status' => $payment_p->status,'created_at' => $payment_p->created_at];
            } else {
                return ['success' => false, 'message' => 'Error occurred while adding new payment provider, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'Payment provider already exists!'];
        }
    }

    public function getPaymentProvider()
    {
        $payment_providers = Payment_Provider::where('status', 'active')->get();

        if ($payment_providers->isNotEmpty()) {
            $payment_p_array = [];
            foreach ($payment_providers as $payment_provider) {
                $payment_p_array[] = [
                    'id' => $payment_provider->id,
                    'name' => $payment_provider->name,
                    'desc' => $payment_provider->desc,
                    'status' => $payment_provider->status,
                    'created_at' => $payment_provider->created_at,
                    'updated_at' => $payment_provider->updated_at,
                ];
            }
            return ['success' => true, 'payment_provider' => $payment_p_array];
        } else {
            return ['success' => false, 'message' => 'No Pyament Provider Found.'];
        }
    }

    public function GetPaymentPById($id)
    {
        $id = base64_decode($id);
        if ($payment_provider = Payment_Provider::where('status', 'active')->find($id)) {
            return ['success' => true, 'id' => $payment_provider->id, 'name' => $payment_provider->name, 'desc' => $payment_provider->desc,'status' => $payment_provider->status, 'created_at' => $payment_provider->created_at];
        } else {
            return ['success' => false, 'message' => 'Error occurred while getting payment provider information'];
        }
    }

    public function UpdatePaymentProvider($data, $id)
    {
        $id = base64_decode($id);
        $payment_provider = Payment_Provider::where('id', $id)->where('status', 'active')->get();

        if (count($payment_provider) > 0) {
            $p = Payment_Provider::find($id);

            $p->name = $data['name'];
            $p->desc = $data['desc'];
            $p->updated_at = now();

            if ($p->save()) {
                return ['success' => true, 'id' => $p->id, 'name' => $p->name, 'desc' => $p->desc, 'status' => $p->status,'created_at' => $p->created_at,'updated_at' => $p->updated_at];
            } else {
                return ['success' => false, 'message' => 'Error occurred while updating payment provider info, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'No payment provider info exist for this ID, try again'];
        }
    }

    public function DeletePaymentProvider($id)
    {
        $id = base64_decode($id);
        $payment_provider = Payment_Provider::where('id', $id)->where('status', 'active')->get();

        if (count($payment_provider) != 0) {
            $p = Payment_Provider::find($id);

            $p->status = 'deleted';
            $p->deleted_at = now();
            
            if ($p->save()) {
                return ['success' => true];
            } else {
                return ['success' => false, 'message' => 'Error While Deleting Payment Provider, try again'];
            }
        } else {
            return ['success' => false, 'message' => 'Payment provider not exist or deleted.'];
        }
    }
}
