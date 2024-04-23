<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersProductos extends Model
{
    use HasFactory;

    //Relacion muchos a muchos con la tabla users
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

    //Relacion muchos a muchos con la tabla productos
    public function productos(){
        return $this->belongsToMany('App\Models\Producto');
    }
}
