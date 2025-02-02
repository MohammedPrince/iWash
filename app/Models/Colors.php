<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Colors extends Model
{
    use HasFactory;
    use HasApiTokens, Notifiable;

    protected $table = 'tbl_colors';

    public static function create(array $data)
    {
        $c = new Colors();
        $c->name = $data['name'];
    
        $c->save();

        return $c->id;
    }
}
