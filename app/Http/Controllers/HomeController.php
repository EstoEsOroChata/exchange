<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    //Método para devolver la vista "home"
    public function __invoke(){
    return view('home');
    }
};