<?php

namespace App\Http\Controllers\Api\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingValidation;
use App\Services\BookingService;

class BookingController extends Controller
{
    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    public function addBookingApi(BookingValidation $request)
    {
        $data = $request->all();
        $errorMsg = $request->newBookingValidation($data);

        if ($errorMsg) {
            return response()->json(['status' => 'error', 'error' => $errorMsg], 422);
        }

        $result = $this->bookingService->addBooking($data);

        
        if ($result['success']) {
 
            return response()->json(['booking_information' => ['status' => 'status', 'status' => $result['message']]], 201);
        } else {
            return response()->json(['booking_information' => ['status' => 'error', 'error' => $result['message']]], 422);
        }
        
    }
}
