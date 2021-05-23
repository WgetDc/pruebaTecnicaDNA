<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $txtBuscar = $request->txtBuscar;
        return view('home', [
            'usuarios' => Usuario::orderBy('nombre')            
                ->where('nombre', 'like', '%'.$txtBuscar.'%')
                ->paginate(2)
        ]);
    }
}
