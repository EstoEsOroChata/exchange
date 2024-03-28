<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'contrasena'
    ];

    protected $hidden = [
        'contrasena',
        'remember_token'
    ];
// Para guardar registros en minúscula y devolverlos con la primera letra en mayúscula
    protected function name(): Attribute
    {
        return new Attribute(
            get: fn($value) => ucwords($value),
            set:  fn($value) => strtolower($value)  
        );
    }
}
