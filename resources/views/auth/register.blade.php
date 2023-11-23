<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>Registro</title>
</head>

<body>
    <form class="formulario" action="{{ route('auth.store') }}" method="post">  
        @csrf
        
        <h1>Registrate</h1>
        <h1>SkyFall Anime Store</h1>
        <div class="contenedor">
            

            
            <div class="input-contenedor">
                <i class="fas fa-envelope icon"></i>
                <input type="text" name="numero_di" placeholder="Numero de documento" required>
            </div>

            <div class="input-contenedor">
                <i class="fas fa-user icon"></i>
                <input type="text" name="primer_nombre" placeholder="Primer Nombre" required>
            </div>

            <div class="input-contenedor">
                <i class="fas fa-user icon"></i>
                <input type="text" name="segundo_nombre" placeholder="Segundo Nombre" >
            </div>

            <div class="input-contenedor">
                <i class="fas fa-user icon"></i>
                <input type="text" name="primer_apellido" placeholder="Primer Apellido" required>
            </div>

            <div class="input-contenedor">
                <i class="fas fa-user icon"></i>
                <input type="text" name="segundo_apellido" placeholder="Segundo Apellido">
            </div>

            <div class="input-contenedor">
                <input type="date" name="fecha_nacimiento" required><br>
            </div>

            <div class="input-contenedor">
                <i class="fas fa-envelope icon"></i>
                <input type="text" name="direccion" placeholder="Direccion" required>
            </div>

            <div class="input-contenedor">
                <i class="fas fa-envelope icon"></i>
                <input type="text" name="telefono" placeholder="Telefono" required>
            </div>
            
            <div class="input-contenedor">
                <select name="ciudad_id" id="ciudad" required>
                    <option value="">Selecciona una ciudad</option>
                    @foreach($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->ciudad }}</option>
                    @endforeach
                </select>
            </div>
                        
            <div class="input-contenedor">
                <i class="fas fa-envelope icon"></i>
                <input type="text" name="correo" placeholder="Correo Electronico" required>
            </div>
            <div class="input-contenedor">
                <i class="fas fa-key icon"></i>
                <input type="password" name="contrasena" placeholder="Contraseña" required>
            </div> 

            <input type="submit" value="Registrate" class="button">
            <p>Al registrarte, aceptas nuestras Condiciones de uso y Política de privacidad.</p>
            <p>¿Ya tienes una cuenta? <a class="link" href="{{ url('/') }}">Iniciar Sesion</a></p>
        </div>
    </form>
</body>

</html>