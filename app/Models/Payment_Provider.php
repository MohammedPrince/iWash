<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Payment_Provider extends Model
{
    use HasFactory; use HasApiTokens, Notifiable;

    protected $table = "tbl_payment_provider";

    public static function create(array $data){
        $p = new Payment_Provider();

        $p->name = $data['name'];
        $p->desc = $data['desc'];

        $p->save();

        return $p->id;
    }
}
