<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function index(){
        $modelos = [
            "Zara",
            "Pull",
            "Nike",
            "Adidas",
            "Lacoste",
        ];
        return view('modelos', ['modelos' => $modelos]);
    }
}
