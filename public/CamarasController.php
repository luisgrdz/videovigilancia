<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CamarasController extends Controller
{
    public function index()
    {
        return view('Camaras/camaras');
    }
}
