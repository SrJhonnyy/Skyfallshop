<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\rol;
use App\Models\estado;
use App\Models\Tipos_d;
use App\Models\ciudad;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{

    //     /*El doble dos puntos "::" sirve como método de resolución de 
    //     ambitos permitiendo utilizar una clase sin instanciarla*/
    // public function index(Request $request)
    // {
    //     $busqueda = $request->busqueda;
    //     $datos = User::where('numero_di', $busqueda)->orWhere('correo', $busqueda)->whereIn('rol_id', [3])->get();
    
    //         /*El doble dos puntos "::" sirve como método de resolución de 
    //         ambitos permitiendo utilizar una clase sin instanciarla*/
    
    //         /*dd($datos); Para consultas de prueba*/  
    //         return view('clientes', compact('datos'));
        

    // }

    public function index(Request $request)
    {
        $datos = User::whereIn('rol_id', [3])->get();
        $busqueda = $request->busqueda;

        $datos = User::where('correo','LIKE','%'. $busqueda.'%')
            ->orWhere('numero_di','LIKE','%'. $busqueda.'%')
            ->where('rol_id', 3)->get();

        /*El doble dos puntos "::" sirve como método de resolución de 
        ambitos permitiendo utilizar una clase sin instanciarla*/

        /*dd($datos); Para consultas de prueba*/  
        return view('clientes',compact('datos'));
    }

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
    public function edit($id)
    {
        $user = User::find($id);
        $ciudades = ciudad::all();
        $roles = rol::where('id', '=', 3)->get();
        $tipoIdentificacion = Tipos_d::all();
        $estados=estado::all();

        

        return view('clientes.edit', compact('user','ciudades','roles','tipoIdentificacion','estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $empleado=user::find($id);
        $datos=$request->all();
            

            $empleado->update($datos);
            
            return redirect('clientes')->with('type','warning')
            ->with('message','Registro actualizado correctamente');
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
        $estado = User::find($inputs['id']);
        $estado -> estado_id = 2;
        $estado -> save();

        return redirect('clientes')->with('type','warning')
                                    ->with('message','Cliente Inactivado correctamente');
    }

    public function activar (Request $request){
        $inputs = $request ->all();
        $estado = User::find($inputs['id']);
        $estado -> estado_id = 1;
        $estado -> save();

        return redirect('clientes')->with('type','success')
                                    ->with('message','cliente Activado correctamente');
    }
}