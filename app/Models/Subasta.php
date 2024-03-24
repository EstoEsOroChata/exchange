<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subasta extends Model
{
    use HasFactory;

    // protected $fillable = ['nombre', 'cantidad', 'puja', 'precio', 'fecha_limite'];

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot(){
        parent::boot();

        static::saving(function ($subasta) {
            $subasta->slug = Str::slug($subasta->nombre);
        });
    }
}
