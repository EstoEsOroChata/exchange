<?php

namespace App\Http\Controllers;

use App\Models\Subasta;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function subastas(Request $request)
    {
        $term = $request->get('term');

        $querys = Subasta::where('name', 'ILIKE', '%'.$term.'%')->get();

        $data = [];

        foreach ($querys as $query) {
            $data[] = [
                'label' => $query->name,
                'value' => $query->name,
                'slug' => $query->slug,
            ];
        }

        return response()->json($data);
    }
}
