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

    public static function create(array $data){
        $o = new Offers();
        $o->service_id = $data['service_id'];
        $o->name = $data['name'];
        $o->desc = $data['desc'];
        $o->discount = $data['discount'];
   
        $o->save();

        return $o->id;
    }

    public function forService(){
        return $this->belongsTo(IwashService::class, 'service_id', 'id');
    }

}
