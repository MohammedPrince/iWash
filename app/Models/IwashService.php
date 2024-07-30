<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class IwashService extends Model
{
    use HasFactory; use HasApiTokens, Notifiable;

    protected $table = "tbl_services";

    public static function create(array $data){

        $i = new IwashService();

        $i->name = $data['name'];
        $i->desc = $data['desc'];
        $i->price = $data['price'];

        $i->save();

        return $i->id;
    }
}
