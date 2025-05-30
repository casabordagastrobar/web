<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


public function index()
{
    $user = Auth::user();

    if ($user->role === 'admin') {
        return view('admin.dashboard');
    } else {
        return view('operador.dashboard'); // crea esta luego si lo necesitas
    }
}

public function crearUsuario()
{
    return view('admin.crear_usuario'); // 👈 esta es tu vista con el formulario
}

public function listarUsuarios()
{
    if (!auth()->check()) {
        abort(403, 'Acceso no autorizado');
    }

    $usuarios = User::where('id', '!=', auth()->id())->get();

    return view('admin.usuarios', compact('usuarios'));
}
public function guardarUsuario(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'role' => 'required|in:admin,operador,jefe', // ✅ asegura que el rol sea válido
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role, // ✅ esta es la corrección
    ]);

    return redirect()->back()->with('success', 'Usuario registrado correctamente');
}


public function modificarUsuario($id)
{
    $usuario = User::findOrFail($id);
    return view('admin.editar_usuario', compact('usuario'));
}

public function actualizarUsuario(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:100',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|min:6|confirmed',
    ]);

    $usuario = User::findOrFail($id);
    $usuario->name = $request->name;
    $usuario->email = $request->email;

    if ($request->filled('password')) {
        $usuario->password = Hash::make($request->password);
    }

    $usuario->save();

    return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente.');
}

public function eliminarUsuario($id)
{
    User::destroy($id);
    return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
}


}
