<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller; // importante si estás en subcarpeta

class PerfilController extends Controller
{
    public function actualizar(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $ruta = public_path('img/perfil.png');

        if (File::exists($ruta)) {
            File::delete($ruta);
        }

        $request->file('foto')->move(public_path('img'), 'perfil.png');

        return back()->with('success', 'Imagen de perfil actualizada.');
    }
}
