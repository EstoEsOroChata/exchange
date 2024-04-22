<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Subasta;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsersProductos;
use Carbon\Carbon;

class SubastaController extends Controller
{
    //Método para mostrar las subastas
    public function index(){

        //Las muestra ordenadas por ID descendente y paginadas
        $subastas = Subasta::orderBy('id', 'desc')->simplePaginate();

        return view('subastas.index', compact('subastas'));
    }

    //Método para mostrar el formulario de creacion de subasta
    public function create(){

        //Obtiene el usuario autenticado y sus productos sin repetirlos
        $user = auth()->user();
        $productos = $user->productos->unique('name');
        return view('subastas.create', compact('productos'));
    }

    //Método para almacenar una nueva subasta
    public function store(Request $request){
        
        //Comprueba que el usuario tiene la cantidad de producto que pone en el formulario
        $userProducto = UsersProductos::where('user_id', auth()->id())->where('producto_id', $request->producto_id)->firstOrFail();
    
        $cantidadDisponible = (int)$userProducto->cantidad;
        $cantidadSolicitada = (int)$request->cantidad;
    
        if ($cantidadDisponible < $cantidadSolicitada) {
            return redirect()->route('subastas.create')->withErrors(['cantidad' => 'La cantidad supera la que tienes disponible.']);
        }

        //Validaciones
        $request->validate([
            'producto_id' => 'required',
            'cantidad' => 'required|numeric|gt:0',
            'puja' => 'required|numeric',
            'precio' => 'required|numeric|gt:puja',
            'duracion_subasta' => 'required|in:12,24,48'
        ]);
        
        //El nombre del producto
        $producto = Producto::findOrFail($request->producto_id);
        //Le asigno un nombre al producto porque los estoy cogiendo por su id
        $nombreProducto = $producto->name;

        //Cálculo para la fecha límite
        $duracionSubasta = $request->input('duracion_subasta');
        $fechaLimite = Carbon::now()->addHours(intval($duracionSubasta));

    
        $subasta = new Subasta();
    
        $subasta->name = $nombreProducto; //Aquí le pongo el nombre que saque antes
        $subasta->cantidad = $request->cantidad;
        $subasta->puja = $request->puja;
        $subasta->pujador_id  = $request->pujador_id;
        $subasta->precio = $request->precio;
        $subasta->fecha_limite = $fechaLimite->toDateTimeString();
        $subasta->user_id = auth()->id();
        $subasta->producto_id = $request->producto_id;
        
        $subasta->save();
        
        //Quitar la cantidad de producto al creador de la subasta
        $userProducto = UsersProductos::where('user_id', auth()->id())->where('producto_id', $request->producto_id)->firstOrFail();
    
        //Le resto la cantidad de producto que ha puesto en subasta
        $userProducto->cantidad -= $request->cantidad;
        $userProducto->save();
    
        return redirect()->route('subastas.show', $subasta);
    }

    //Método para mostrar una subasta
    public function show(Subasta $subasta){

        return view('subastas.show', compact('subasta'));
    }

    //Método para editar una subasta
    public function edit(Subasta $subasta){

        //Comprueba si el usuario es el creador de la subasta
        if ($subasta->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar esta subasta.');
        }

        return view('subastas.edit', compact('subasta'));
    }

    //Método para actualizar el precio de una subasta
    public function update(Request $request, Subasta $subasta) {
        
        //Comprueba si el usuario es el creador de la subasta
        if ($subasta->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para editar esta subasta.');
        }
        
        //Actualiza el precio
        $subasta->precio = $request->precio;

        $subasta->save();

        return redirect()->route('subastas.show', $subasta);
    }

    //Método para pujar en las subastas
    public function pujar(Subasta $subasta, Request $request)
{
    //Validaciones
    $request->validate([
        'puja' => 'required|numeric|min:0',
    ]);

    //Se supone que esto comprueba la fecha pero creo que no va
    if ($subasta->fecha_limite < now()) {
        return redirect()->back()->with('error', 'La fecha límite de la subasta ha pasado.');
    }

    $user = auth()->user();

    //Comprueba si tiene oro
    if ($user->oro < $request->puja) {
        return redirect()->back()->with('error', 'No tienes suficiente oro para realizar esta puja.');
    }

    //Resto oro
    if ($user instanceof \App\Models\User) {
        $user->decrement('oro', $request->puja);
    } else {
        return redirect()->back()->with('error', 'Error al procesar la compra.');
    }

    //Actualiza la puja y el pujador_id
    $subasta->puja = $request->puja;
    $subasta->pujador_id = $user->id;
    $subasta->save();

    return redirect()->back()->with('success', 'Puja realizada con éxito.');
}

    //Método para comprar un producto
    public function comprar(Subasta $subasta)
{
    //Para comprobar si el usuario esta logeado y tiene oro
    if (auth()->check() && auth()->user()->oro >= $subasta->precio) {
        //Le baja el oro
        $user = auth()->user();
        if ($user instanceof \App\Models\User) {
            $user->decrement('oro', $subasta->precio);
        } else {
            return redirect()->back()->with('error', 'Error al procesar la compra.');
        }

        //Usuario que crea la subasta
        $creadorSubasta = $subasta->user;

        //Le da el oro al creador de la subasta
        $creadorSubasta->increment('oro', $subasta->precio);

        //Le da los productos al comprador
        $producto = Producto::findOrFail($subasta->producto_id);
        $producto->users()->attach(auth()->id(), ['cantidad' => $subasta->cantidad]);

        $subasta->delete();

        return redirect()->route('subastas.index')->with('success', 'Compra realizada con éxito.');
    } else {
        return redirect()->route('subastas.show', $subasta)->with('error', 'No tienes suficiente oro para comprar este producto.');
    }
}
    
    //Metodo para terminar la subasta, recoger el dinero y entregar el producto al pujador
    public function finalizarSubasta(Subasta $subasta)
    {
    // Verificar si el usuario actual es el creador de la subasta
    if (auth()->user()->id !== $subasta->user_id) {
        return redirect()->back()->with('error', 'No tienes permiso para finalizar esta subasta.');
    }

    // Le da los productos al comprador
    $producto = Producto::findOrFail($subasta->producto_id);
    $producto->users()->attach($subasta->pujador_id, ['cantidad' => $subasta->cantidad]);

    // Le da el oro al creador de la subasta
    $creadorSubasta = $subasta->user;
    $creadorSubasta->increment('oro', $subasta->puja);

    // Elimina la subasta
    $subasta->delete();

    return redirect()->route('subastas.index')->with('success', 'Subasta finalizada con éxito.');
}

//Método para eliminar una subasta
public function destroy(Subasta $subasta){
    
    //Si la puja es mayor a 0 y hay un pujador asignado, devuelve el oro al pujador
    if ($subasta->puja > 0 && $subasta->pujador_id) {
        $pujador = User::findOrFail($subasta->pujador_id);
        $pujador->increment('oro', $subasta->puja);
    }

    //Relaciona el producto con el usuario
    $userProducto = UsersProductos::where('user_id', $subasta->user_id)->where('producto_id', $subasta->producto_id)->firstOrFail();

    //Le devuelve los productos al usuario
    $userProducto->cantidad += $subasta->cantidad;
    $userProducto->save();

    $subasta->delete();

    return redirect()->route('subastas.index');
}

}
