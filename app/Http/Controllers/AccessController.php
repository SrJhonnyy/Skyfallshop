<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario; 
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Comentario;
use App\Models\TipoDI;
use App\Models\Ciudad;


use Illuminate\Http\Request;
use Session;

class AccessController extends Controller
{
    public function index(){
        $products = Product::all();
    
        return view('index', [
            'products' => $products,
        ]);
    }
    

    public function destination($id){
        $product = Product::find($id);
        $gallery = Gallery::where('producto_id', $id)->get();
        $comentario = Comentario::where('producto_id', $id)->get();

        return view('destination',[
            'product' => $product,
            'galerias' => $gallery,
            'comentarios' => $comentario
        ]);
    }

    public function profile(){
        $usuario = Usuario::find(session('usuario')['id']);

        return view('profile', [
            'usuario' => $usuario,
        ]);
    }

    public function login(){
        return view('auth.login');
    }

    public function register(){
        $tiposDI = TipoDI::all();
        $ciudades = Ciudad::all();

        return view('auth.register', [
            'tiposDI' => $tiposDI,
            'ciudades' => $ciudades
        ]);
    }

    public function authenticate (Request $request){

        $credentials = $request->only('email', 'password');

        $usuario = Usuario::where('correo', $credentials['email'])->where('contrasena', $credentials['password'])->get();
        
        if($usuario->count() > 0) {
            $usuario = Usuario::where('correo', $credentials['email'])->where('contrasena', $credentials['password'])->first();

            session(['usuario' => [
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

        dd($usuario->count());

        if (Auth::attempt($credentials)) {
            
        } 
    }

    /*public function store(Request $request){
        $validate = $request->validate([
            'tipo_di_id' => 'required',
            'numero_di' => 'required | numeric | max:20',
            'primer_nombre' => 'required | string | max:15',
            'segundo_nombre' => 'string| nullable | max:15',
            'primer_apellido' => 'required | string | max:15',
            'segundo_apellido' =>'string | nullable |max:15',
            'fecha-nacimiento' =>'required|date',
            'direccion' =>'required|string',
            'telefono' =>'required|numeric| max:15',
            'ciudad_id' => 'required',
            'correo' => 'required|unique:users,correo',
            'contrasena' => 'required',
        ]);
        $data = $request->except('contrasena');
        $data['contrasena'] = Hash::make($request->password);
        Usuario::create($data);
        return redirect('/');
    }*/

    public function logout(Request $request){
        session()->flush();

        return redirect('/');
    }

    public function compra(){
        $usuario = Usuario::find(session('usuario')['id']);
        //$product = Product::find($id);

        return view('compra', [
            'usuario' => $usuario,
            //'product'=> $product
        ]);
    }

    public function store(Request $request) {
        $inputs =  $request->all();
        $usuario = new Usuario;

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
        $usuario->ciudad_id = $inputs['ciudad_id'];
        $usuario->estado_id = 1;
        $usuario->save();

        return redirect('/');
    }

    /*public function store(Request $request)
    {
        $usuario = Usuario::create([
            'tipo_di_id' => $request->input['tipo_di_id'],
            'numero_id' => $request->input['numero_id'],
            'primer_nombre' => $request->input['primer_nombre'],
            'segundo_nombre' => $request->input['segundo_nombre'],
            'primer_apellido'=> $request->input['primer_apellido'],
            'segundo_apellido'=> $request->input['segundo_apellido'],
            'fecha_nacimiento'=> $request [date('fecha_nacimiento')],
            'direccion' => $request->input['direccion'],
            'telefono' => $request->input['telefono'],
            'correo' =>  $request->input['correo'],
            'contrasena'=>$request ['contrasena'],
            'ciudad_id' => $request->input ['ciudad_id'],
        ]);
        return "Registro realizado";
    }*/


}

