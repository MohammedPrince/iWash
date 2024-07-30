<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserRole extends Model
{
    use HasFactory; use HasApiTokens, Notifiable;
    protected $table = "tbl_roles";

    public static function create(array $data){
        $r = new UserRole();
        $r->name = $data['name'];
        $r->desc = $data['desc'];

        $r->save();

        return $r->id;
    }


}
