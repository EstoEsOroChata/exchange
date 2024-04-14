<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    public function show($id)
{
    $perfil = Perfil::find($id); // Suponiendo que tu modelo se llama Perfil

    // Lógica para mostrar el perfil...

    return view('perfil.show', ['perfil' => $perfil]);
}
}
