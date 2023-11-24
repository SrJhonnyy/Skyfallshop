<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ImagenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Ajusta según tus necesidades de autenticación
    }

    public function mostrarFormulario()
    {
        return view('formulario-imagen');
    }

    public function guardarImagen(Request $request)
    {
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ajusta según tus necesidades
        ]);

        try {
            $usuario = auth()->user(); // Obtén el usuario autenticado actual

            $imagen = $request->file('imagen');
            $imagenName = $imagen->getClientOriginalName();
            $imagen->move(public_path('img/perfil/'), $imagenName);
            $usuario->imagen = 'img/perfil/' . $imagenName;
            $usuario->save();

            // Puedes agregar aquí la lógica para guardar la imagen en tu sistema de archivos o base de datos

            return redirect()->back()->with('success', 'La imagen se ha guardado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ha ocurrido un error al guardar la imagen.');
        }
    }
}
