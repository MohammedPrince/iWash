<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Vehicles extends Model
{
    use HasFactory; use HasApiTokens, Notifiable;
    protected $table = "tbl_vehicles";

    public static function create(array $data){
        
        $v = new Vehicles();

        $v->name = $data['name'];
        $v->user_id = $data['user_id'];
        $v->model_id = $data['model_id'];
        $v->color_id = $data['color_id'];
        $v->plate = $data['plate'];
        $v->mfg = $data['mfg'];
        $v->make_year = $data['make_year'];

        $v->save();

        return $v->id;
    }
}
