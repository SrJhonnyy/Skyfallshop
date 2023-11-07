<!DOCTYPE html>
<html lang="en">

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
    <title>SKYFALL Anime Store</title>
</head>

<body>

    <header>

        <div id="menu-bar" class="fas fa-bars"></div>
        

        <a href="#" class="logo"><span>S</span>KYFALL</a>

        <nav class="navbar">
            <a href="#home">Inicio</a>
            <a href="#book">Escribenos</a>
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
				<div class="container-cart-icon">
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
                        <div id="carrito-items" class= "texto-carrito"></div>
                        <div class="cart-total">
                            <h3>Total:</h3>
                            <span id="total-pagar" class="pago">$</span>
                        </div>
                        <button class="cta">
                                <span class="hover-underline-animation"><a href="{{ url ('/compra') }}">Comprar ahora </a></span>
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
            <input type="email" class="box" placeholder="Ingrese su email" name="email">
            <input type="password" class="box" placeholder="Ingrese su contraseña" name="password">
            <input type="submit" value="Login now" class="btn">
            <input type="checkbox" id="remember">
            <label for="remember">Recordar</label>
            <p>Olvidaste tu contraseña? <a href="#">click aqui</a></p>
            <p>No tienes cuenta? <a href="{{ url('register') }}">Registrarse ahora</a></p>
        </form>
    </div>
    <!--home section stars-->

    <section class="home" id="home">
        <div class="content">
            <h3></h3>
            <p></p>
            
        </div>

        <div class="controls">
            <span class="vid-btn active" data-src="{{ asset('img/video1.mp4') }}"></span>
            <span class="vid-btn" data-src="{{ asset('img/video2.mp4') }}"></span>
        </div>

        <div class="video-container">
            <video src="{{ asset('img/video1.mp4') }}" id="video-slider" loop autoplay muted></video>
        </div>

    </section>

    <!--home section ends-->
    <!-- book section stars-->

    <section class="book" id="book">

        <h1 class="heading">
            <span>E</span>
            <span>S</span>
            <span>C</span>
            <span>R</span>
            <span>I</span>
            <span>B</span>
            <span>E</span>
            <span>N</span>
            <span>O</span>
            <span>S</span>
        </h1>

        <div class="row">
            <div class="image">
                <img src="{{ asset('img/escribenos.png') }}" alt="">
            </div>

            <form action="">
                <div class="inputBox">
                    <h3>¿Que buscas?</h3>
                    <input type="text" placeholder="Producto que buscas">
                </div>
                <div class="inputBox">
                    <h3>¿Cuantos necesitas?</h3>
                    <input type="number" placeholder="Cantidad">
                </div>
                <div class="inputBox">
                    <h3>Fecha deseada</h3>
                    <input type="date">
                </div>

                <input type="submit" class="btn" value="book now">
            </form>
        </div>
    </section>
    <!-- book section ends-->

    </section>

    <!--Services section-->
    <section class="services" id="services">
        <h1 class="heading">
            <span>S</span>
            <span>E</span>
            <span>R</span>
            <span>V</span>
            <span>I</span>
            <span>C</span>
            <span>I</span>
            <span>O</span>
            <span>S</span>
        </h1>

        <div class="box-container">

            <div class="box">
                <i class="fas fa-gamepad"></i>
                <h3>Video Juegos</h3>
                <p>Sumérgete en un mundo de entretenimiento y emoción con nuestra amplia selección de videojuegos. Desde juegos de acción hasta aventuras épicas, tenemos algo para cada tipo de jugador. ¡Prepárate para vivir experiencias únicas y emocionantes!

</p>
                </p>
            </div>
            <div class="box">
                <i class="fas fa-video"></i>
                <h3>Anime y Pelis</h3>
                <p>Descubre un universo de historias cautivadoras y personajes inolvidables a través de nuestro catálogo de anime y películas. Desde clásicos atemporales hasta los últimos lanzamientos, te invitamos a explorar un sinfín de emociones y aventuras en la pantalla.

</p>
                </p>
            </div>
            <div class="box">
                <i class="fab fa-fantasy-flight-games"></i>
                <h3>Plataformas Stream</h3>
                <p>Accede a las mejores plataformas de streaming y disfruta de tus programas y películas favoritas en alta definición. Te ofrecemos acceso a un mundo de entretenimiento desde la comodidad de tu hogar. ¡No te pierdas ningún episodio!

</p>
                </p>
            </div>
            <div class="box">
                <i class="fas fa-leaf"></i>
                <h3>Alimentos Japoneses</h3>
                <p>Experimenta la deliciosa y variada gastronomía japonesa con nuestra selección de alimentos auténticos. Desde sushi fresco hasta ramen reconfortante, te llevaremos a un viaje culinario a Japón sin salir de casa. ¡Sabores exquisitos te esperan!

</p>
                </p>
            </div>
            <div class="box">
                <i class="fas fa-headset"></i>
                <h3>Servicio al Cliente</h3>
                <p>Nuestro compromiso es atender tus necesidades y preguntas de la mejor manera posible. Nuestro equipo de servicio al cliente está aquí para ayudarte en cada paso del camino. Siempre estamos dispuestos a brindarte asistencia amigable y eficiente para garantizar una experiencia excepcional con nosotros.

</p>
                </p>
    
            </div>
        </div>
    </section>
    <!--services section ends-->

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

            <div class="box">
                <img src="{{ asset('img/galery/1.jpg') }}" alt="">
                <div class="content">
                    <h3>Pochita</h3>
                    <p>Pochita es el Demonio Motosierra que encarna el miedo a las motosierras.</p>
                    <a href="#" class="btn">Ver más</a>
                </div>
            </div>
            <div class="box">
                <img src="{{ asset('img/galery/2.jpg') }}" alt="">
                <div class="content">
                    <h3>Naruto</h3>
                    <p>Naruto es una serie Japonesa muy famosa, aqui alguno de sus productos.</p>
                    <a href="#" class="btn">Ver más</a>
                </div>
            </div>
            <div class="box">
                <img src="{{ asset('img/galery/3.jpg') }}" alt="">
                <div class="content">
                    <h3>Demon Slayer</h3>
                    <p>SKimetsu no Yaiba, también conocida bajo su nombre en inglés Demon Slayer, o en español Cazador de demonios.</p>
                    <a href="#" class="btn">Ver más</a>
                </div>
            </div>
            <div class="box">
                <img src="{{ asset('img/galery/4.jpg') }}" alt="">
                <div class="content">
                    <h3>Marvel</h3>
                    <p>El mundo UCM de Marvel y sus Funko Pops!.</p>
                    <a href="#" class="btn">Ver más</a>
                </div>
            </div>
            <div class="box">
                <img src="{{ asset('img/galery/5.jpg') }}" alt="">
                <div class="content">
                    <h3>SkyFall</h3>
                    <p>Anime Store</p>
                    <a href="#" class="btn">Ver más</a>
                </div>
            </div>
            <div class="box">
                <img src="{{ asset('img/galery/6.jpg') }}" alt="">
                <div class="content">
                    <h3>Naruto</h3>
                    <p>Productos de Naruto.</p>
                    <a href="#" class="btn">Ver más</a>
                </div>
            </div>
            <div class="box">
                <img src="{{ asset('img/galery/7.jpg') }}" alt="">
                <div class="content">
                    <h3>Mas de Demons Slayer</h3>
                    <p>Billeteras de la serie.</p>
                    <a href="#" class="btn">Ver más</a>
                </div>
            </div>
            <div class="box">
                <img src="{{ asset('img/galery/8.jpg') }}" alt="">
                <div class="content">
                    <h3>Billeteras</h3>
                    <p>De todo tipo y gustos.</p>
                    <a href="#" class="btn">Ver más</a>
                </div>
            </div>
            <div class="box">
                <img src="{{ asset('img/galery/9.jpg') }}" alt="">
                <div class="content">
                    <h3>Funko Pops!</h3>
                    <p>Para los amantes del coleccionismo!</p>
                    <a href="#" class="btn">Ver más</a>
                </div>
            </div>
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
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="{{ asset('img/Comentarios/ibai.png') }}" alt="">
                    <div class="texto">
                        <h3>Ibai Llanos</h3>
                        <p>Excelente mercancia, gran calidad y precios!!</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('img/Comentarios/rubius.png') }}" alt="">
                    <div class="texto">
                        <h3>ElRubius</h3>
                        <p>Una gran variedad de funkos, genial en todos los aspectos.</p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <img src="{{ asset('img/Comentarios/greft.png') }}" alt="">
                    <div class="texto">
                        <h3>Grefg</h3>
                        <p>La mejor experiencia de mi vida. Agradecido ... </p>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

    </section>
    <!--review section ends -->
    
    <!-- footer section starts-->
    <section class="footer">
        <div class="box-container">
            <div class="box">
                <h3>Sobre nosotros</h3>
                <p>SkyFall es un grupo empresarial fundado por un par de jovenes universitarios apasionados. Nuestra empresa esta compuesta por dos marcas:
                    SkyFall Anime Store y SkyFall Accesorios. Trabajamos de la mano para ofrecer productos de alta calidad y proyectar nuestro creimiento en el mercado. </p>
            </div>
            <div class="box">
                <h3>Productos</h3>
                <a href="#">Anime</a>
                <a href="#">Manga</a>
                <a href="#">Marvel</a>
                <a href="#">Comics</a>
            </div>
            <div class="box">
                <h3>Acceso Rapido</h3>
                <a href="#">Inicio</a>
                <a href="#">Paquetes</a>
                <a href="#">Servicios</a>
                <a href="#">Galeria</a>
                <a href="#">Comentarios</a>

            </div>
            <div class="box">
                <h3>Siguenos</h3>
                <a href="#">facebook</a>
                <a href="#">instagram</a>
                <a href="#">twitter</a>
            </div>
        </div>
        <h1 class="credit"> create by <span> Developer Skyfall </span> | all rignts reserved!</h1>
    </section>


    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>

</body>

</html>