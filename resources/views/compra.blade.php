<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/pagpago.css') }}">
    <title>Document</title>
</head>
<body>

<button class="cta">
    <span><a href="{{ url('/') }}" class="texto">Regresar</a></span>
    <svg viewBox="0 0 13 10" height="10px" width="15px">
        <path d="M1,5 L11,5"></path>
        <polyline points="8 1 12 5 8 9"></polyline>
    </svg>
</button>

    <section class="seccion-perfil-usuario">
    <div class="perfil-usuario-body">
        <div class="perfil-usuario-bio">
            <h3 class="titulo">{{ $usuario->primer_nombre.' '.$usuario->primer_apellido}}</h3>
        </div>
        <div class="perfil-usuario-footer-container"> <!-- Nuevo contenedor -->
            <div class="content-detail perfil-usuario-footer">

        <!-- División entre productos y datos de compra -->
        <div class="contenido-vista-compra">
            <!-- Productos -->
            <div class="productos">
                <div class="texto-derecha"><h1>Productos</h1></div>
                <div id="cnt-paquetes" class="box-container"></div>
                <span>
                    <strong>Total a pagar:</strong>
                    <span id="total-pagar"></span>
                </span>
            </div>

            <!-- Datos de compra -->
            <form action="xxx" method="POST" class="datos-compra">
                <h1>Datos de compra</h1>
                <input type="hidden" name="usuario_id" value="{{ $usuario->id  }}">
                <ul class="lista-datos">
                    <li><i class="bi bi-arrow-bar-right"></i>Nombres: {{ $usuario->primer_nombre.''.$usuario->segundo_nombre  }}</li>
                    <li><i class="bi bi-arrow-bar-right"></i>Apellidos: {{ $usuario->primer_apellido.' '.$usuario->segundo_apellido  }} </li>
                    <li><i class="icono fas fa-calendar-alt"></i>Fecha nacimiento: {{ $usuario->fecha_nacimiento  }}</li>
                </ul>
                <ul class="lista-datos">
                    <li><i class="icono fas fa-map-marker-alt"></i>Ubicacion: {{ $usuario->direccion}} </li>
                    <li><i class="icono fas fa-phone-alt"></i>Telefono:  {{ $usuario->telefono}}</li>
                    <li><i class="bi bi-envelope-open-fill"></i>Correo: {{ $usuario->correo}} </li>
                </ul>
            </form>
        </div>

    </div>
</section>



<button class="finalizar-compra">Finalizar compra</button>

<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<!-- <script src="{{ asset('js/compra.js') }}"></script> -->
<script>
    const itemsCart = document.querySelector('#cnt-paquetes');
    var contentCart = JSON.parse(localStorage.getItem('cart'));

    function showProducts() {
        var html = '';
        totalCart = 0;

        itemsCart.innerHTML = '';

        for(var i = 0; i < contentCart.length; i++){
            var id = contentCart[i].id;
            var imagen = contentCart[i].imagen;
            var titulo = contentCart[i].titulo;
            var descripcion = contentCart[i].descripcion;
            var precio = contentCart[i].precio;

            // Aumentar total carrito.
            totalCart = totalCart + parseInt(precio);

            // Añadir item al carrito.
            html += '<div class="box">';
            html += '<input type="hidden" name="productos[]" value="' + id + '"/>';
            html += '<img src="' + imagen + '" alt="" style="width: 100px;">';
            html += '<div class="content">';
            html += '<h3><i class="titulo-producto-carrito"></i>' + titulo + '</h3>';
            html += '<p class="text-justify">' + descripcion + '</p>';
            html += '<span class="precio-producto-carrito">$' + precio + '</span> ';
            html += '</div>';
            html += '</div>';
        }

        document.querySelector('#total-pagar').innerHTML = '$' + totalCart;
        itemsCart.innerHTML = html;
    }

    showProducts();
</script>

<script>
    function generarPDF() {
        // Accede al ID de la compra directamente desde la URL
        var idCompra = window.location.pathname.split('/').pop();

        // Crea un enlace temporal para la descarga
        var link = document.createElement('a');
        
        // Establece la URL del archivo PDF
        link.href = `/compra/${idCompra}/pdf`;

        // Establece el atributo de descarga con el nombre del archivo
        link.download = 'factura_compra.pdf';

        // Simula un clic en el enlace para iniciar la descarga
        link.click();
    }
</script>
 
</body>
</html>
