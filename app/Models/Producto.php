<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    //Relación uno a muchos
    public function subastas(){
        return $this->hasMany('App\Model\Subasta');
    }

    //Relación muchos a muchos con la tabla intermedia
    public function usersProductos(){
        return $this->belongsToMany('App\Models\UsersProductos');
    }

    //Relación muchos a muchos con la tabla intermedia y filtra la cantidad de producto si es "0"
    public function users()
    {
        return $this->belongsToMany(User::class, 'users_productos', 'producto_id', 'user_id')->withPivot('cantidad')->wherePivot('cantidad', '>', 0);
    }
}
