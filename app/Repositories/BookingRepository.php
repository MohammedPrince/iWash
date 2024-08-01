<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\Locations;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use PHPUnit\Exception;

class BookingRepository extends BaseRepository
{
    public function model()
    {
        return Booking::class;
    }

    public function addBooking($data)
    {

        //->where('status', 'pending')
        $booking = Booking::where('user_id', $data['user_id'])->where('service_id', $data['service_id'])->where('vehicle_id', $data['vehicle_id'])->get();

        if (count($booking) == 0) {
            if ($booking = Booking::create($data)) {
                $lastInsertedId = $booking;

                $booking = Booking::with('getUserDetails')->with('getServiceDetails')->with('getVehicleDetails')->find($lastInsertedId);

                if($this->AutoAssignServiceProvider($lastInsertedId, $data['user_id'])){
                    return ['success' => true, 'message' => 'Booking successfully added in time-slot, Thank you !'];
                }else{
                    return ['success' => false, 'message' => 'Error occurred while adding new booking, try again!'];
                }

            } else {
                return ['success' => false, 'message' => 'Error occurred while adding new booking, try again!'];
            }
        } else {
            return ['success' => false, 'message' => 'Booking already exists!'];
        }
    }

    public function AutoAssignServiceProvider($booking_id, $customer_id)
    {
   

        $fn_status = false;
        $service_provider_ids = [];
        $service_provider_locations = [];

        $customerLocation = Locations::where('user_id', $customer_id)->first();

        $cus_lat = $customerLocation->latitude;
        $cus_lon = $customerLocation->longitude;
        $cus_location = $cus_lat . ',' . $cus_lon;

        $service_provider = User::where('status', 'available')->where('role_id', 2)->get();

        foreach ($service_provider as $provider) {
            $service_provider_ids[] = $provider->id;
        }

        $provider_locations = Locations::whereIn('user_id', $service_provider_ids)->get();

        foreach ($provider_locations as $location) {
            $service_provider_locations[] = $location->latitude . ',' . $location->longitude;
        }

        $nearest_provider_id = $this->Nearest_SP_Location($service_provider_ids, $provider_locations, $cus_lat, $cus_lon);

        //if we found service provider in range of 5km or less 
        if ($nearest_provider_id >0) {
            // Update booking table with service_provider_id (nearest_provider_id).
            $tbl_booking = Booking::find($booking_id);

            $tbl_booking->service_provider_id = $nearest_provider_id;
            $tbl_booking->status = 'confirmed';
            $tbl_booking->updated_at = now();

            // Update users table with set service_provider_id status = busy //role_id = 2
            $tbl_users = User::find($nearest_provider_id);

            $tbl_users->status = 'busy';
            $tbl_users->updated_at = now();

            if ($tbl_users->save() && $tbl_booking->save()) {
                $fn_status = true;
            } else {
                $fn_status = false;
            }
        }

        return $fn_status ;
    }

    // Function to find the nearest service provider
    function Nearest_SP_Location($Service_Provider_ids_array, $ServiceProvider_locations_array, $cus_lat, $cus_lon)
    {
        $nearest_providers_names = [];
        $nearest_providers_id = [];
        $range = 5; 

        foreach ($ServiceProvider_locations_array as $key => $location) {
            $distance = $this->calculateDistance($cus_lat, $cus_lon, $location->latitude, $location->longitude);

            if ($distance <= $range) {
                $nearest_provider_id = $Service_Provider_ids_array[$key];
                $nearest_provider = User::find($nearest_provider_id);
                $nearest_providers_names[] = $nearest_provider->username;
                $nearest_providers_id = $nearest_provider->id;
            }
        }

        return $nearest_providers_id;
    }

    // Function to calculate the distance between SP and Customer location and retrun KMs
    function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $kilometers = $miles * 1.609344;
        return $kilometers;
    }
}
