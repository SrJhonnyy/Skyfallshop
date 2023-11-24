<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\rol;
use App\Models\estado;
use App\Models\Tipos_d;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Validator;

class ProveedoresController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $datos = Proveedor::where('nit', 'LIKE', '%'.$busqueda. '%' )
           ->orWhere('correo','LIKE', '%'. $busqueda.'%')->get();
    
    
            /*El doble dos puntos "::" sirve como método de resolución de 
            ambitos permitiendo utilizar una clase sin instanciarla*/
    
            /*dd($datos); Para consultas de prueba*/  
            return view('proveedores', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $estados = estado::all();
        return view('proveedores.new', compact('estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validador=validator::make($request->all(),[

        'primer_nombre'=>'required|max:50',
        'segundo_nombre'=>'required|max:50',
        'primer_apellido'=>'required|max:50',
        'segundo_apellido'=>'required|max:50',
        'numero_di'  => 'required|max:50',
        'tipo_di_id'=>'required',
        'fecha_nacimiento'=>'required',
        'ciudad_id'  => 'required',
        'direccion'=>'required|max:100',
        'telefono'=>'required|max:11',
        'correo'=>'required|max:100|email',
        'contrasena' => 'required',
        'rol_id'=>'required',
        'estado_id'=>'required'
    ]);

    $datos=$request->all();
    Proveedor::create($datos);
    return redirect()->route('proveedores')
                        ->with('type','success')
                        ->with('message','Registro creado exitosamente.');
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
        $proveedor = Proveedor::find($id);
        $estados = estado::all();
        return view('proveedores.edit', compact('proveedor','estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $proveedores=Proveedor::find($id);

        $datos=$request->all();

        $proveedores->update($datos);
            
            return redirect('proveedores')->with('type','warning')
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
        //
    }

}