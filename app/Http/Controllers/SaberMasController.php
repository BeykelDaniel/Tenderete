<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaberMasController extends Controller
{
    public function index()
    {
        // El punto (.) indica que 'saber_mas' está dentro de la carpeta 'pagina'
        return view('pagina.saber_mas');
    }
}
