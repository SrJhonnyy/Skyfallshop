<?php

namespace App\Http\Controllers;
use App\Models\solicitud;

use Illuminate\Http\Request;

class BajaController extends Controller
{
    public function mostrarFormulario()
    {
        return view('solicitud-baja');
    }

    public function enviarSolicitud(Request $request)
    {
        $solicitud = new solicitud;
        $inputs = $request->all();

        $solicitud->motivo = $inputs['motivo'];
        $solicitud->usuarios_id = $inputs['id'];
        $solicitud->save();

        return view('solicitud-confirmacion');
    }
}
