<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function iniciarSesion(Request $request)
{
    // Validar los input
    $request->validate([
        'correo' => 'required|email',
        'password' => 'required'
    ]);

    $credentials = [
        'email' => $request->correo,
        'password' => $request->password
    ];

    // Inicio de sesión
    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('operador.dashboard');
        }
    }

    // 👇 Esto es lo que te faltaba
    return redirect()->back()->with('error', 'Correo o contraseña incorrectos');
}

}
