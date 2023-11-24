<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\Incluye;
use App\Models\User;
use App\models\Tipos_d;
class FacturaController extends Controller{



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $facturas = Factura::all();
        $incluyen = Incluye::all();
        $productos = Producto::all();
        $categorias = Categoria::all();
        $tipoIdentificacion = Tipos_d::all();
        $user = User::all();
        
        return view('ventas', compact('facturas', 'productos', 'incluyen', 'categorias','tipoIdentificacion', 'user'));
        // dd($facturas->toArray());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function consultar(Request $request)
        {
        $inputs = $request->all();
        //dd($inputs);
        $productos_factura = [];

        if($inputs['categoria'] != null) {
            // Por categoria.
            $productos_factura = Incluye::join('productos', 'productos.id', 'incluyen.producto_id')
                ->select('incluyen.factura_id')
                ->where('productos.categoria_id', $inputs['categoria'])
                ->get();
        }

        $arrFacturas = [];

        foreach($productos_factura as $producto_factura){ 
            $arrFacturas[] = $producto_factura->factura_id;
        }

        $facturas = Factura::find($arrFacturas);
        $tipoIdentificacion = Tipos_d::all();
        $incluyen = Incluye::all();
        $productos = Producto::all();
        $categorias = Categoria::all();
        $user = User::all();

        return view('ventas', compact('facturas', 'productos', 'incluyen', 'categorias', 'tipoIdentificacion','user'));
    }
    public function buscar(Request $request){

        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');
        // dd($fechaInicio);
        // dd($fechaFin);
        
        $facturas = Factura::whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->get();

            
        $incluyen = Incluye::all();
        $tipoIdentificacion = Tipos_d::all();
        $productos = Producto::all();
        $categorias = Categoria::all();
        $user = User::all();

        return view('ventas', compact('facturas', 'productos', 'incluyen', 'categorias', 'tipoIdentificacion', 'user'));

        }
    }