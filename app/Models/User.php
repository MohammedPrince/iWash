<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = "tbl_users";

    public static function create(array $data){
        $u = new User();
        $u->first_name = $data['first_name'];
        $u->last_name = $data['last_name'];
        $u->username = $data['username'];
        $u->password = bcrypt($data['password']);
        $u->phone = $data['phone'];
        $u->email = $data['email'];
        $u->verified = 'YES';
        $u->image_url = 'path/to/img';
        $u->role_id = $data['role_id'];
        $u->login_type = 'mobile';
        $u->login_identity = 'login_identity' ;

        $u->save();

        return $u->id;
    }


    public function userRole(){
        return $this->belongsTo(UserRole::class, 'role_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function location(){
        return $this->belongsTo(Locations::class, 'user_id', 'id');
    }
}
