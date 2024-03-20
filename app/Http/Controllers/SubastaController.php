<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubastaController extends Controller
{
    public function index(){
        return view('subastas.index');
    }

    public function create(){
        return view('subastas.create');
    }

    public function show($subasta){
        return view('subastas.show', compact('subasta'));
    }
}
