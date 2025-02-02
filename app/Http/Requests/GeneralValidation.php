<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class GeneralValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function newRoleValidation($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:100|min:5|unique:tbl_roles',
            'desc' => 'required|string|max:500',
        ], [
            'name.required' => 'Please Enter Role Name',
            'desc.required' => 'Please Enter Role Description',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }

    public function existRoleValidation($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:100|min:5',
            'desc' => 'required|string|max:500',
        ], [
            'name.required' => 'Please Enter Role Name',
            'desc.required' => 'Please Enter Role Description',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }

    public function newServiceValidation($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:100|min:5|unique:tbl_services',
            'desc' => 'required|string|max:500',
            'price' => 'required|numeric|max:99999|',
        ], [
            'name.required' => 'Please Enter Service Name',
            'desc.required' => 'Please Enter Service Description',
            'price.required' => 'Please Enter Service Price',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }

    public function existServiceValidation($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:100|min:5',
            'desc' => 'required|string|max:500',
            'price' => 'required|numeric|max:99999|',
        ], [
            'name.required' => 'Please Enter Service Name',
            'desc.required' => 'Please Enter Service Description',
            'price.required' => 'Please Enter Service Price',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }

    public function newVehicleValidation($data)
    {
        $validator = Validator::make($data, [
            'user_id' => 'required|numeric|max:2|min:1',
            'name' => 'required|string|max:100|min:5|unique:tbl_vehicles',
            'model_id' => 'required|numeric|max:2|min:1',
            'color_id' => 'required|numeric|max:2|min:1',
            'plate' => 'required|string|max:25|unique:tbl_vehicles',
            'mfg' => 'required|string|max:100',
            'make_year' => 'required|string|max:100',
        ], [
            'user_id.required' => 'Please Enter Customer Name',
            'name.required' => 'Please Enter Name',
            'model_id.required' => 'Please Select Car Model',
            'color_id.required' => 'Please Select Car Color',
            'plate.required' => 'Please Enter Plate Number',
            'mfg.required' => 'Please Enter MFG',
            'make_year.required' => 'Please Enter Car Make Year',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }

    public function newCarColorValidation($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:50|min:3|unique:tbl_colors',
        ], [
            'name.required' => 'Please Enter Color Name',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }
    public function existCarColorValidation($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:50|min:3',
        ], [
            'name.required' => 'Please Enter Color Name',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }
    public function newCarModelValidation($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:50|min:3|unique:tbl_v_models',
            'desc' => 'required|string|max:500|min:5',
        ], [
            'name.required' => 'Please Enter Model Name',
            'desc.required' => 'Please Enter Model Description',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }
    public function updateCarModelValidation($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:50|min:3',
            'desc' => 'required|string|max:500|min:5',
        ], [
            'name.required' => 'Please Enter Model Name',
            'desc.required' => 'Please Enter Model Description',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }

    public function newOfferValidation($data)
    {
        $validator = Validator::make($data, [
            'service_id' => 'required|numeric|unique:tbl_offers',
            'name' => 'required|string|max:100|min:5|unique:tbl_offers',
            'desc' => 'required|string|max:500',
            'discount' => 'required|numeric|max:99999',
        ], [
            'service_id.required' => 'Please Select Service',
            'name.required' => 'Please Enter Offer Name',
            'desc.required' => 'Please Enter Offer Description',
            'discount.required' => 'Please Enter Offer Discount',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }

    public function updateOfferValidation($data)
    {
        $validator = Validator::make($data, [
            'service_id' => 'required|numeric',
            'name' => 'required|string|max:100|min:5',
            'desc' => 'required|string|max:500',
            'discount' => 'required|numeric|max:99999',
        ], [
            'service_id.required' => 'Please Select Service',
            'name.required' => 'Please Enter Offer Name',
            'desc.required' => 'Please Enter Offer Description',
            'discount.required' => 'Please Enter Offer Discount',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }

    public function newPaymentProviderValidation($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:100|min:5|unique:tbl_payment_provider',
            'desc' => 'required|string|max:500',
        ], [
            'name.required' => 'Please Enter Payment Provider Name',
            'desc.required' => 'Please Enter Payment Provider Description',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }

    public function updatePaymentProviderValidation($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:100|min:5',
            'desc' => 'required|string|max:500',
        ], [
            'name.required' => 'Please Enter Payment Provider Name',
            'desc.required' => 'Please Enter Payment Provider Description',
        ]);

        if ($validator->fails()) {
            return [
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()->toArray()
            ];
        }
        return [];
    }
}
