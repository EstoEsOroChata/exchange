<?php

namespace App\Http\Controllers;

use App\Models\Subasta;
use Illuminate\Http\Request;

class SubastaController extends Controller
{
    public function index(){

        $subastas = Subasta::orderBy('id', 'desc')->paginate();

        return view('subastas.index', compact('subastas'));
    }

    public function create(){
        return view('subastas.create');
    }

    public function store(Request $request){
        $subasta = new Subasta();

        $subasta->nombre = $request->nombre;
        $subasta->cantidad = $request->cantidad;
        $subasta->puja = $request->puja;
        $subasta->precio = $request->precio;
        $subasta->fecha_limite = $request->fecha_limite;

        $subasta->save();

        return redirect()->route('subastas.show', $subasta);
    }

    public function show(Subasta $subasta){

        return view('subastas.show', compact('subasta'));
    }

    public function edit(Subasta $subasta){

        return view('subastas.edit', compact('subasta'));
    }

    public function update(Request $request, Subasta $subasta) {

        $subasta->nombre = $request->nombre;
        $subasta->cantidad = $request->cantidad;
        $subasta->puja = $request->puja;
        $subasta->precio = $request->precio;
        $subasta->fecha_limite = $request->fecha_limite;

        $subasta->save();

        return redirect()->route('subastas.show', $subasta);
    }
}
