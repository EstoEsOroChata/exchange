<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subasta extends Model
{
    use HasFactory;

    //Ningún campo está protegido, así que son asignables
    protected $guarded = [];

    //Relación uno a muchos (inverso)
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //Relación uno a muchos (inverso)
    public function producto(){
        return $this->belongsTo('App\Models\Producto');
    }

    //Método para generar un campo para la ruta de la subasta
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Método que se ejecuta al crear una subasta
    protected static function boot(){
        parent::boot();
    
        static::creating(function ($subasta) {
            //Genera el slug seguido de un id único para identificar cada subasta aunque sean del mismo producto
            $subasta->slug = Str::slug($subasta->name . '-' . uniqid());
        });
    }
}
