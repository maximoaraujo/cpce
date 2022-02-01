<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Operadores_monitor;
use Illuminate\Support\Facades\Hash;
use Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function iniciarSesion(Request $request)
    {
        $user = Operadores_monitor::where('NombreUsuario', $request->username)->count();

        if($user > 0){
            $id = Operadores_monitor::where('NombreUsuario', $request->username)->pluck('OperadorMonitorId')->first();
            $password = Operadores_monitor::where('NombreUsuario', $request->username)->pluck('Contrasena')->first();
            if (md5($request->password) == $password){
                session(['userid' => $id]);
                return redirect()->route('home');
            } else {
                session(['userid' => null]);
                return redirect()->route('login')->with('username', 'Comuniquese solicitando');
            }
        } else {
            return redirect()->route('login')->with('username', 'Error usuario');
        }
    }

    public function logout()
    {
        session(['userid' => null]);
        return redirect()->route('login');
    }
}
