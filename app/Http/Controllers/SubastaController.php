<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubasta;
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

    public function store(StoreSubasta $request){

        $subasta = Subasta::create($request->all());

        return redirect()->route('subastas.show', $subasta);
    }

    public function show(Subasta $subasta){

        return view('subastas.show', compact('subasta'));
    }

    public function edit(Subasta $subasta){

        return view('subastas.edit', compact('subasta'));
    }

    public function update(StoreSubasta $request, Subasta $subasta) {

        $subasta->update($request->all());

        return redirect()->route('subastas.show', $subasta);
    }

    public function destroy(Subasta $subasta){

            $subasta->delete();

            return redirect()->route('subastas.index');
    }
}
