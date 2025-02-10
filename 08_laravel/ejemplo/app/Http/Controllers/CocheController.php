<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CocheController extends Controller
{
    public function index(){
        $coches = [
            ["Mazda RX7", "Marca1", 3000],
            ["Mercedes CLA", "Marca2", 4000],
            ["Peugeot 307 MS", "Marca3", 5000],
            ["Fiat Multipla", "Marca4", 6900],
        ];
        return view('coches', ['coches' => $coches]);
    }
}
