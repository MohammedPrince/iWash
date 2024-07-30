<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Offers extends Model
{
    use HasFactory; use HasApiTokens, Notifiable;

    protected $table = "tbl_offers";


    public function forService(){
        return $this->belongsTo(IwashService::class, 'service_id', 'id');
    }

}
