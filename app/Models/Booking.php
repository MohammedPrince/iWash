<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Booking extends Model
{
    use HasFactory;
    use HasApiTokens, Notifiable;

    protected $table = 'tbl_booking';

    public static function create(array $data)
    {
        $b = new Booking();

        $b->user_id = $data['user_id'];
        $b->service_id = $data['service_id'];
        $b->vehicle_id = $data['vehicle_id'];
        $b->start_date = $data['start_date'];
        $b->booking_time = $data['booking_time'];
        $b->end_date = $data['end_date'];
        $b->user_note = $data['user_note'];

        $b->save();

        return $b->id;
    }

    public function getUserDetails()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getServiceDetails()
    {
        return $this->belongsTo(IwashService::class, 'service_id', 'id');
    }

    public function getVehicleDetails()
    {
        return $this->belongsTo(Vehicles::class, 'vehicle_id', 'id');
    }
}
