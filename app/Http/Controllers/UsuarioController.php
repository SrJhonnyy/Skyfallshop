<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\rol;
use App\Models\estado;
use App\Models\Tipos_d;
use App\Models\ciudad;
use Illuminate\Support\Facades\Validator;

class usuariosController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $datos = User::where('numero_di', 'LIKE', '%'.$busqueda. '%' )->whereIn('rol_id', [4])->get();
    
    
            /*El doble dos puntos "::" sirve como método de resolución de 
            ambitos permitiendo utilizar una clase sin instanciarla*/
    
            /*dd($datos); Para consultas de prueba*/  
            return view('usuarios', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipos_di = Tipos_d::all();
        $ciudades = ciudad::all();
        $estados = estado::all();
        $roles = Rol::whereIn('id', [4])->get();
        $empleados = user::all();
        return view('usuarios.new', compact('estados','roles','empleados','ciudades','tipos_di'));
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
    User::create($datos);
    return redirect()->route('usuarios')
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
        $user = User::find($id);
        $ciudades = ciudad::all();
        $roles = Rol::whereIn('id', [1,2,4])->get();
        $tipoIdentificacion = Tipos_d::all();
        $estados=estado::all();

        

        return view('usuarios.edit', compact('user','ciudades','roles','tipoIdentificacion','estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $empleado=user::find($id);
        $datos=$request->all();
            

            $empleado->update($datos);
            
            return redirect('usuarios')->with('type','warning')
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

        return redirect('usuarios')->with('type','warning')
                                    ->with('message','usuarios Inactivado correctamente');
    }

    public function activar (Request $request){
        $inputs = $request ->all();
        $estado = User::find($inputs['id']);
        $estado -> estado_id = 1;
        $estado -> save();

        return redirect('usuarios')->with('type','success')
                                    ->with('message','usuarios Activar correctamente');
    }
}