<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://necolas.github.io/normalize.css/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <title>Profile</title>
</head>
<body>
    <!--==========================
=            html            =
===========================-->
<button>
    <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024"><path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path></svg>
    <span><a href="{{ url('/') }}">Regresar</a></span>
  </button>

    <section class="seccion-perfil-usuario">
        <div class="perfil-usuario-header">
            <div class="perfil-usuario-portada">
                <div class="perfil-usuario-avatar">
                    <img src="{{ asset('img/perfil/'.'/'.$usuario->imagen) }}">
                </div>
                
            </div>
        </div>
        <div class="perfil-usuario-body">
            <div class="perfil-usuario-bio">
                <h3 class="titulo">{{ $usuario->primer_nombre.' '.$usuario->primer_apellido}}</h3>
            </div>
            <div class="perfil-usuario-footer">
                <ul class="lista-datos">
                    <li><i class="bi bi-arrow-bar-right"></i>Nombres: {{ $usuario->primer_nombre.''.$usuario->segundo_nombre  }}</li>
                    <li><i class="bi bi-arrow-bar-right"></i>Apellidos: {{ $usuario->primer_apellido.''.$usuario->segundo_apellido  }}</li>
                    <li><i class="icono fas fa-calendar-alt"></i>Fecha de nacimiento: {{ $usuario->fecha_nacimiento}}</li>
                </ul>
                <ul class="lista-datos">
                    <li><i class="icono fas fa-map-marker-alt"></i>Ubicacion: {{ $usuario->direccion}} </li>
                    <li><i class="icono fas fa-phone-alt"></i>Telefono: {{ $usuario->telefono}}</li>
                    <li><i class="bi bi-envelope-open-fill"></i>Correo: {{ $usuario->correo}} </li>
                </ul>
            </div>
            <button class="btn-1">
                <span><a href="{{ url('/') }}">Cerrar sesión</a></span>
            </button>
        </div>
    </section>

        
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/carrito.js') }}"></script>



</body>
</html>