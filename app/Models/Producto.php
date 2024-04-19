<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function subastas(){
        return $this->hasMany('App\Model\Subasta');
    }

//Relación muchos a muchos
    public function usersProductos(){
        return $this->belongsToMany('App\Models\UsersProductos');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_productos', 'producto_id', 'user_id')->withPivot('cantidad')->wherePivot('cantidad', '>', 0);
    }
}
