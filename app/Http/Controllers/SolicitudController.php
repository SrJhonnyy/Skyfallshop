<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\User;
use App\Models\rol;
use App\Models\Incluye;
use App\Models\estado;
use App\Models\Tipos_d;
use App\Models\ciudad;
use App\Models\Solicitud;
use Illuminate\Support\Facades\Validator;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $busqueda = $request->busqueda;

        $datos = Solicitud::join('usuarios','usuarios.id','=','solicitudes.usuarios_id')
            ->where('usuarios.primer_nombre', 'LIKE', '%'.$busqueda. '%' )
            ->orWhere('usuarios.id', $busqueda)->get();

        /*El doble dos puntos "::" sirve como método de resolución de 
        ambitos permitiendo utilizar una clase sin instanciarla*/

        return view('solicitudes',compact('datos'));
    }
        // dd($facturas->toArray());

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function inactivar (Request $request){
        $inputs = $request ->all();
        $usuarios = User::find($inputs['id']);
        $usuarios -> estado_id = 2;
        $usuarios -> save();

        return redirect('solicitudes')->with('type','warning')
                                    ->with('message','usuarios Inactivado correctamente');
    }

    public function activar (Request $request){
        $inputs = $request ->all();
        $usuarios = User::find($inputs['id']);
        $usuarios -> estado_id = 1;
        $usuarios -> save();

        return redirect('solicitudes')->with('type','success')
                                    ->with('message','usuarios Activado correctamente');
    }
}
