<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Producto;
use App\Models\Imagen;
use App\Models\Comentario;
use App\Models\Tipos_d;
use App\Models\Ciudad;
use App\Models\Factura;
use App\Models\Incluye;
use Illuminate\Http\Request;
use Session;

class WebController extends Controller
{
    public function index(){
        $productos = Producto::where('categorias_id', 1)->get();

        return view('index', [
            'productos'=>$productos
        ]);
    }

    public function destination($id){
        $productos = Producto::find($id);
        $imagen = Imagen::where('producto_id', $id)->get();
        $comentario = Comentario::where('producto_id', $id)->get();

        return view('destination',[
            'product' => $producto,
            'galerias' => $imagen,
            'comentarios' => $comentario
        ]);
    }

    public function profile(){
        $usuario = User::find(session('usuarios')['id']);

        return view('profile', [
            'usuarios' => $usuario,
        ]);
    }

    public function login(){
        return view('auth.login');
    }

    public function register(){
        $tiposDI = Tipos_d::all();
        $ciudades = Ciudad::all();

        return view('auth.register', [
            'tiposDI' => $tiposDI,
            'ciudades' => $ciudades
        ]);
    }

    public function authenticate (Request $request){

        $credentials = $request->only('email', 'password');

        $usuario = User::where('correo', $credentials['email'])->where('contrasena', $credentials['password'])->get();
        
        if($usuario->count() > 0) {
            $usuario = User::where('correo', $credentials['email'])->where('contrasena', $credentials['password'])->first();

            session(['usuarios' => [
                'id' => $usuario->id,
                'nombre' => $usuario->primer_nombre.' '.$usuario->primer_apellido,
                'correo' => $usuario->correo,
            ]]);

            return redirect()->intended('/');
        } else{
            return back()->withErrors([
                'correto' => 'Las credenciales ingresadas no coinciden.',
            ]);
        }

        if (Auth::attempt($credentials)) {
            
        } 
    }

    public function logout(Request $request){
        session()->flush();

        return redirect('/');
    }

    public function compra(){
        $usuario = User::find(session('usuarios')['id']);

        return view('compra', [
            'usuarios' => $usuario,
        ]);
    }

    public function store(Request $request) {
        $inputs =  $request->all();
        $usuario = new User;

        $usuario->numero_di = $inputs['numero_di'];
        $usuario->primer_nombre = $inputs['primer_nombre'];
        $usuario->segundo_nombre = $inputs['segundo_nombre'];
        $usuario->primer_apellido = $inputs['primer_apellido'];
        $usuario->segundo_apellido = $inputs['segundo_apellido'];
        $usuario->fecha_nacimiento = $inputs['fecha_nacimiento'];
        $usuario->direccion = $inputs['direccion'];
        $usuario->telefono = $inputs['telefono'];
        $usuario->correo = $inputs['correo'];
        $usuario->contrasena = $inputs['contrasena'];
        $usuario->tipo_di_id = $inputs['tipo_di_id'];
        $usuario->ciudad_id = $inputs['ciudad_id'];
        $usuario->estado_id = 1;
        $usuario->rol_id = 4;
        $usuario->save();

        return redirect('/');
    }

    public function factura(Request $request) {
        $inputs = $request->all();
        $factura = new Factura;

        $factura->fecha= date('Y-m-d');
        $factura->total_factura = $inputs['total'];
        $factura->usuarios_id = $inputs['usuarios_id'];
        $factura->metodo_de_pago_id= 4;
        $factura->save();

        $usuarios= User::find($inputs['usuarios_id']);
        $usuarios->rol_id = 3;
        $usuarios->save();

        for($i = 0; $i < count($inputs['productos']); $i++){
            
            $incluye = new Incluye;

            $incluye->factura_id= $factura->id;
            $incluye->producto_id= $inputs['productos'][$i];
            $incluye->save(); 
            
            return redirect ('/');
    }
}


















/* Jhan */

public function Actualizar(){
    $usuarios = User::find(session('usuarios')['id']);
    $usuarios = User::all();
    $tiposDI = Tipos_d::all();
    $ciudades = Ciudad::all();

    return view('Actualizar', [
        'usuarios' => $usuarios,
        'tiposDI' => $tiposDI,
        'ciudades' => $ciudades,
        'usuarios' => $usuarios,
    ]);

}

public function actualizado(Request $request){
    $inputs = $request ->all();
    $usuarios = User::find($inputs['id']);

    $usuarios->numero_di = $inputs['numero_di'];
    $usuarios->primer_nombre = $inputs['primer_nombre'];
    $usuarios->segundo_nombre = $inputs['segundo_nombre'];
    $usuarios->primer_apellido = $inputs['primer_apellido'];
    $usuarios->segundo_apellido = $inputs['segundo_apellido'];
    $usuarios->fecha_nacimiento = $inputs['fecha_nacimiento'];
    $usuarios->direccion = $inputs['direccion'];
    $usuarios->telefono = $inputs['telefono'];
    $usuarios->correo = $inputs['correo'];
    $usuarios->contrasena = $inputs['contrasena'];
    $usuarios->tipo_di_id = $inputs['tipo_di_id'];
    $usuarios->ciudad_id = $inputs['ciudad_id'];
    $usuarios->save();

    return view('profile', [
        'usuarios' => $usuarios,

    ]);

}

}

