<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Vehicle_Models extends Model
{
    use HasFactory; use HasApiTokens, Notifiable;
    protected $table = "tbl_v_models";

    public static function create(array $data){
        
        $m = new Vehicle_Models();
        $m->name = $data['name'];
        $m->desc = $data['desc'];

        $m->save();

        return $m->id;
    }


}
