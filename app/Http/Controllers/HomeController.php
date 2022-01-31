<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Operadores_monitor;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (session('userid') != null) {
            $name = Operadores_monitor::where('OperadorMonitorId', session('userid'))->pluck('NombreApellido');
            foreach ($name as $n) {
                $username = $n;
            }

            return view('home', compact('username'));
        } else {
            return view('login');
        }
    }
}
