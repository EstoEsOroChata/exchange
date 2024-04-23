<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    public function show($id)
{
    //Busca el perfil con el ID asignado
    $perfil = Perfil::find($id);

    //Redirecciona a la vista "perfil" con el ID de perfil asignado
    return view('perfil.show', ['perfil' => $perfil]);
}
}
