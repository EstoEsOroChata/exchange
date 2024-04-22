<?php

namespace App\Http\Controllers;

use App\Models\Subasta;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //Método para buscar subastas
    public function subastas(Request $request)
    {
        //Obtiene el término de la búsqueda del request
        $term = $request->get('term');

        //Busca las subastas que coincidan en algún fragmento con el término, independientemente de si es mayus o minus
        $querys = Subasta::where('name', 'ILIKE', '%'.$term.'%')->get();

        //Aquí se guarda todos los resultados
        $data = [];

        //Recorre todas las subastas encontradas y construye el array de resultados
        foreach ($querys as $query) {
            $data[] = [
                'label' => $query->name,
                'value' => $query->name,
                'slug' => $query->slug,
            ];
        }

        //Devuelve los resultados en JSON
        return response()->json($data);
    }
}
