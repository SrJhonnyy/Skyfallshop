<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Estado;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 
        $busqueda = $request->busqueda;

$datos = Producto::where(function ($query) use ($busqueda) {
    $query->where('nombre', 'LIKE', '%' . $busqueda . '%')
        ->orWhere('descripcion', 'LIKE', '%' . $busqueda . '%')
        ->orWhere('id', 'LIKE', '%' . $busqueda . '%');

})
    ->orderBy('id')
    ->paginate(100);


        /*El doble dos puntos "::" sirve como método de resolución de 
        ambitos permitiendo utilizar una clase sin instanciarla*/

        /*dd($datos); Para consultas de prueba*/  
        return view('Productos',compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = categoria::all();
        $proveedores = proveedor::all();
        $estados = estado::all();
        return view('productos.new', compact('categorias','proveedores','estados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        
        $validador=validator::make($request->all(),[
            
            'nombre'=>'required|max:50',
            'descripcion'=>'required|max:100',
            'valor_unitario'=>'required|max:10',
            'disponibilidad'=>'required|max:11',
            'categoria_id'  => 'requered',
            'proveedor_id'  => 'requered',
            'estado_id' => 'requered']);
            
        $datos=$request->all();
        
        $producto = new Producto;

        $producto->nombre = $datos['nombre'];
        $producto->descripcion = $datos['descripcion'];
        $producto->valor_unitario = $datos['valor_unitario'];
        $producto->disponibilidad = $datos['disponibilidad'];
        $producto->categoria_id = $datos['categoria_id'];
        $producto->proveedor_id = $datos['proveedor_id'];
        $producto->estado_id = $datos['estado_id'];


         if($request->file('imagen')){   

            $imagen = $request->file('imagen');
            $imagenName = $imagen->getClientOriginalName();
            $imagen->move(public_path('img/productos/'), $imagenName);
            $producto->imagen = 'img/productos/'.$imagenName;
        } else {
             $producto->imagen = 'img/productos/viaje.png';

         }

        $producto->save();

            
        return redirect()->route('productos')
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
        $producto = Producto::find($id);
        $categorias = categoria::all();
        $proveedores = proveedor::all();
        $estados = estado::all();
        return view('productos.edit', compact('producto','categorias','proveedores','estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $producto=Producto::find($id);
        
        $datos=$request->all();

        $producto->nombre = $datos['nombre'];
        $producto->descripcion = $datos['descripcion'];
        $producto->valor_unitario = $datos['valor_unitario'];
        $producto->disponibilidad = $datos['disponibilidad'];
        $producto->categoria_id = $datos['categoria_id'];
        $producto->proveedor_id = $datos['proveedor_id'];


         if($request->file('imagen')){   

            $imagen = $request->file('imagen');
            $imagenName = $imagen->getClientOriginalName();
            $imagen->move(public_path('img/productos/'), $imagenName);
            $producto->imagen = 'img/productos/'.$imagenName;
        }

        $producto->save();

            
        return redirect()->route('productos')
                         ->with('type','success')
                         ->with('message','Registro Actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
    public function inactivar(Request $request)
{
    $inputs = $request->all();

    $dato = Producto::find($inputs['id']);
    $dato->estado_id = 2;
    $dato->save();

    return redirect('productos')->with('type','warning')
                                ->with('message','Producto Inactivado correctamente');
}

    public function activar(Request $request)
{
    $inputs = $request->all();

    $dato = Producto::find($inputs['id']);
    $dato->estado_id = 1;
    $dato->save();

    return redirect('productos')->with('type','success')
                                ->with('message','Producto Activado correctamente');
}
}
