<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class BookingValidation extends FormRequest
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

     public function newBookingValidation($data)
     {
         $validator = Validator::make($data, [
             'user_id' => 'required|numeric|max:999',
             'service_id' => 'required|numeric|max:999',
             'vehicle_id' => 'required|numeric|max:999',
             'start_date' => 'required|string|max:100|min:5',
             'booking_time' => 'required|string|max:100|min:4',
             'end_date' => 'required|string|max:100|min:5',
             'user_note' => 'string|max:1000|min:0',
         ], [
             'user_id.required' => 'Please Select User',
             'service_id.required' => 'Please Select Service',
             'vehicle_id.required' => 'Please Select Your Car',
             'start_date.required' => 'Please Enter Start Date',
             'booking_time.required' => 'Please Enter Booking Time',
             'end_date.required' => 'Please Enter End Date',
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
