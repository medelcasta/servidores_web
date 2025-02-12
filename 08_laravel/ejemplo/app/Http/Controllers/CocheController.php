<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CocheController extends Controller
{
    public function index(){
        $coches = [
            ["RX7", "Mazda", 20000],
            ["CLA", "Mercedes", 40000],
            ["Mustang", "Ford", 500000],
            ["307 MS", "Peugeot", 50000],
            ["Multipla", "Fiat", 69000],
            ["C15", "Citroën", 790000],
            ["Pajero", "Mitsubichi", 45000]
        ];

        return view('coches', ['coches' => $coches]);
    }
}
