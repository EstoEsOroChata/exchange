<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubasta;
use App\Models\Producto;
use App\Models\Subasta;
use Illuminate\Http\Request;

class SubastaController extends Controller
{
    public function index(){

        $subastas = Subasta::orderBy('id', 'desc')->paginate();

        return view('subastas.index', compact('subastas'));
    }

    public function create(){
        $user = auth()->user();
        $productos = $user->productos->unique('name');
        return view('subastas.create', compact('productos'));
    }

    public function store(Request $request){
        
        // Obtener el nombre del producto seleccionado
        $producto = Producto::findOrFail($request->producto_id);
        $nombreProducto = $producto->name;
    
        // Crear la subasta
        $subasta = new Subasta();
    
        $subasta->name = $nombreProducto; // Asignar el nombre del producto a la subasta
        $subasta->cantidad = $request->cantidad;
        $subasta->puja = $request->puja;
        $subasta->precio = $request->precio;
        $subasta->fecha_limite = $request->fecha_limite;
        $subasta->user_id = auth()->id();
        $subasta->producto_id = $request->producto_id;
    
        $subasta->save();
    
        return redirect()->route('subastas.show', $subasta);
    }

    public function show(Subasta $subasta){

        return view('subastas.show', compact('subasta'));
    }

    public function edit(Subasta $subasta){

        if ($subasta->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar esta subasta.');
        }

        return view('subastas.edit', compact('subasta'));
    }

    public function update(Request $request, Subasta $subasta) {
        var_dump($subasta->user_id, auth()->id());
        if ($subasta->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar esta subasta.');
        }
        
        $subasta->puja = $request->puja;
        $subasta->precio = $request->precio;
        $subasta->fecha_limite = $request->fecha_limite;

        $subasta->save();

        return redirect()->route('subastas.show', $subasta);
    }

    public function destroy(Subasta $subasta){

            $subasta->delete();

            return redirect()->route('subastas.index');
    }
}
