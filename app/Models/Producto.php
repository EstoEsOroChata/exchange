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
}
