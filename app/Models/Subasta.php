<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subasta extends Model
{
    use HasFactory;

    // protected $fillable = ['nombre', 'cantidad', 'puja', 'precio', 'fecha_limite'];

    protected $guarded = [];
}
