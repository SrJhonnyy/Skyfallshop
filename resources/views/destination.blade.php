<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="SKYFALL" type="jpg" href="{{ asset('img/img4.jpg') }}">
    <title>SKYFALL</title>
</head>

<body>

    <header>

        <div id="menu-bar" class="fas fa-bars"></div>

        <a href="index.php" class="logo"><span>V</span>ayica</a>

        <nav class="navbar">
            <a href="{{ url('/')}}">Inicio</a>
            <a href="#packages">Paquetes</a>
            <a href="#services">Servicios</a>
            <a href="#gallery">Galeria</a>
            <a href="#review">Comentarios</a>
        </nav>

        <div class="icons">
            @if(isset(session('usuario')['id']))
                <span class='user'><a href="{{ url('/profile')}}">{{ session('usuario')['nombre'] }}</a> | <a href="{{ url('/logout') }}">Salir</a></span>
            @endif
            
            <i class="fas fa-user {{ isset(session('usuario')['id']) ? 'hidden' : '' }}" id="login-btn"></i>
        </div>
        <form action="" class="search-bar-container">
            <input type="search" id="search-bar" placeholder="search here..">
            <label for="search-bar" class="fas fa-search"></label>
        </form>
        <div id="btnCart" class="container-icon">
				<div class="1">
					<svg
						xmlns="http://www.w3.org/2000/svg"
						fill="none"
						viewBox="0 0 24 24"
						stroke-width="1.5"
						stroke="currentColor"
						class="icon-cart"
					>
						<path
							stroke-linecap="round"
							stroke-linejoin="round"
							d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"
						/>
					</svg>
					<div class="count-products">
						<span id="contador-productos"></span>
					</div>
				</div>

				<div  class="container-cart-products hidden-cart">
                    <div id="carrito-lleno" class="hidden">
                        <div id="carrito-items" class="texto-carrito"></div>
                        <div class="cart-total">
                            <h3>Total:</h3>
                            <span id="total-pagar" class="pago">$</span>
                        </div>
                        <button class="cta">
                                <span class="hover-underline-animation"><a href="{{ url ('/compra') }}">Comprar ahora</a></span>
                                <svg viewBox="0 0 46 16" height="10" width="30" xmlns="http://www.w3.org/2000/svg" id="arrow-horizontal">
                                    <path transform="translate(30)" d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" data-name="Path 10" id="Path_10"></path>
                                </svg>
                            </button>
                    </div>
					<p id="carrito-vacio" class="cart-empty">El carrito está vacío</p>
				</div>
			</div>
    </header>

    <!--login form container-->
    <div class="login-form-container">

        <i class="fas fa-times" id="form-close"></i>

        <form action="{{ route('auth.authenticate') }}" method="post">
            @csrf
            <h3>Iniciar sesion</h3></a>
            <input type="correo" class="box" placeholder="enter your email">
            <input type="contraseña" class="box" placeholder="enter your password">
            <input type="submit" value="login now" class="btn">
            <input type="checkbox" id="remember">
            <label for="remember">Recordar</label>
            <p>Olvidaste tu contraseña? <a href="#">click aqui</a></p>
            <p>No tienes cuenta? <a href="{{ url('register') }}">registrar ahora</a></p>

        </form>
    </div>

    <!--home section stars-->

    <section class="home" id="home">
        <div class="content">
            <h3></h3>
            <p></p>
            <a href="#" class="btn">Descubre más</a>
        </div>

        <div class="controls">
            <span class="vid-btn active" data-src="{{ asset('img/video1.mp4') }}"></span>
            <span class="vid-btn" data-src="{{ asset('img/video2.mp4')}}"></span>
        </div>

        <div class="video-container">
            <video src="{{ asset('img/video1.mp4') }}" id="video-slider" loop autoplay muted></video>
        </div>

    </section>


    <!-- packages section stars-->

    <section class="packages" id="packages">

        <h1 class="heading">   
        </h1>
<!-- packages section ends-->

<div class="box-container">
    @foreach ($products as $product)
        <div class="box">
            <!-- ... Tu código de presentación de productos ... -->
            <button class="btn btn-add-to-cart"
                    data-product-id="{{ $product->id }}"
                    data-product-name="{{ $product->nombre }}"
                    data-product-price="{{ $product->valor_unitario }}"
                    data-product-description="{{ $product->descripcion }}">
                Agregar al carrito
            </button>
        </div>
    @endforeach
</div>

<script src="{{ asset('js/carrito.js') }}"></script>


    </section>

    <!--gallery section star-->
    <section class="gallery" id="gallery">
        <h1 class="heading">
            <span>G</span>
            <span>A</span>
            <span>L</span>
            <span>E</span>
            <span>R</span>
            <span>I</span>
            <span>A</span>
        </h1>

        <div class="box-container">
            @foreach ($galerias as $galeria)
                <div class="box">
                    <img src="{{ asset('img/destinos/').'/'.$galeria->imagen }}" alt="">
                    <div class="content">
                        <h3>{{$galeria->nombre}}</h3>
                        <p>{{$galeria->descripcion}}</p>  
                    </div>
                </div>
            @endforeach
        </div>

  
    </section>
    <!--gallery section ends-->

    <!-- review section starts -->
    <section class="review" id="review">

        <h1 class="heading">
            <span>C</span>
            <span>O</span>
            <span>M</span>
            <span>E</span>
            <span>N</span>
            <span>T</span>
            <span>A</span>
            <span>R</span>
            <span>I</span>
            <span>O</span>
            <span>S</span>
        </h1>

        <!--<script> alert('Comentario enviado!')</script>-->

        <div class='container'>
            @foreach ($comentarios as $comentario)
                <div class="coments">
                    <table>
                        <tr>
                            <td rowspan="3">
                                <img src="{{ asset('img/perfil/')}}" alt="" class="avatar">
                            </td>
                            <td>
                                <p class="text-coment">{{ $comentario->contenido }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Autor: <i>{{ $comentario->usuario->primer_nombre.' '.$comentario->usuario->primer_apellido }}</i></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                </div>
                            </td>
                        </tr>
                    </table>

                    <div class="texto">
                        
                    </div>
                </div>
            @endforeach
        </div>

        <form method="post">
            <textarea rows="5" name="contenido" class="coment" placeholder="Escribe aquí tu comentario..."></textarea>
            <button type="submit" class="btn btn-primary coment-button">
                Enviar comentario
            </button>
        </form>
        
    </section>  
    <!--review section ends -->


    <!-- footer section starts-->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>Sobre nosotros</h3>
                <p>Lorem ipson dolor sit amet consectetur adipisicing elit. Ipsa adipisici
                    quisquam sunt nesciunt fugiat odit minus illum asperiores dolorum enim sint
                    quod ipsam distinctio molestias consectetur ducimus beatae, reprehenderit exercitationem!</p>
            </div>
            <div class="box">
                <h3> locations</h3>
                <a href="#">India</a>
                <a href="#">USA</a>
                <a href="#">Japan</a>
                <a href="#">France</a>
            </div>
            <div class="box">
                <h3>Quick links</h3>
                <a href="#">home</a>
                <a href="#">book</a>
                <a href="#">packages</a>
                <a href="#">services</a>
                <a href="#">gallery</a>
                <a href="#">review</a>
                <a href="#">contact</a>
            </div>
            <div class="box">
                <h3>Siguenos</h3>
                <a href="#">facebook</a>
                <a href="#">instagram</a>
                <a href="#">twitter</a>
            </div>
        </div>
        <h1 class="credit"> create by <span> mr. web designer </span> | all rignts reserved!</h1>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/carrito.js') }}"></script>

</body>

</html>