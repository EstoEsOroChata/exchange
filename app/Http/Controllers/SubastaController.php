<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubasta;
use App\Models\Producto;
use App\Models\Subasta;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UsersProductos;
use Carbon\Carbon;

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
        //dd($request->all());
        $request->validate([
            'cantidad' => 'required|numeric|gt:0',
            'puja' => 'required|numeric',
            'precio' => 'required|numeric|gt:puja',
            'duracion_subasta' => 'required|in:12,24,48'
        ]);
        
        //El nombre del producto
        $producto = Producto::findOrFail($request->producto_id);
        $nombreProducto = $producto->name;

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
        //dd($subasta);
        //Quitar la cantidad de producto al creador de la subasta
        $userProducto = UsersProductos::where('user_id', auth()->id())->where('producto_id', $request->producto_id)->firstOrFail();
    
        $userProducto->cantidad -= $request->cantidad;
        $userProducto->save();
    
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
        
        $subasta->precio = $request->precio;
        //$subasta->fecha_limite = $request->fecha_limite;

        $subasta->save();

        return redirect()->route('subastas.show', $subasta);
    }


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

    //Comprueba si tiene oro (si va)
    if ($user->oro < $request->puja) {
        return redirect()->back()->with('error', 'No tienes suficiente oro para realizar esta puja.');
    }

    //Resto oro (si va)
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
