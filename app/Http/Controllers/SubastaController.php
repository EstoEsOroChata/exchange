<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubasta;
use App\Models\Producto;
use App\Models\Subasta;
use Illuminate\Http\Request;
use App\Models\User;

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

    public function comprar(Subasta $subasta)
{
    // Verificar si el usuario está autenticado y tiene suficiente "oro" para comprar
    if (auth()->check() && auth()->user()->oro >= $subasta->precio) {
        // Reducir el "oro" del comprador
        $user = auth()->user();
        if ($user instanceof \App\Models\User) {
            $user->decrement('oro', $subasta->precio);
        } else {
            // Manejar el caso en que $user no sea una instancia de User
            return redirect()->back()->with('error', 'Error al procesar la compra.');
        }

        // Asociar el producto al usuario
        $producto = Producto::findOrFail($subasta->producto_id);
        $producto->users()->attach(auth()->id(), ['cantidad' => 1]); // Asociar al usuario y definir la cantidad

        // Eliminar la subasta
        $subasta->delete();

        return redirect()->route('subastas.index')->with('success', 'Compra realizada con éxito.');
    } else {
        return redirect()->route('subastas.show', $subasta)->with('error', 'No tienes suficiente oro para comprar este producto.');
    }
}
    

    public function destroy(Subasta $subasta){

            $subasta->delete();

            return redirect()->route('subastas.index');
    }
}
