let searchBtn = document.querySelector('#search-btn');
let searchBar = document.querySelector('.search-bar-container');
let formBtn = document.querySelector('#login-btn');
let loginForm = document.querySelector('.login-form-container');
let formClose = document.querySelector('#form-close');
let menu = document.querySelector('#menu-bar');
let navbar = document.querySelector('.navbar');
let videoBtn = document.querySelectorAll('.vid-btn');
let totalCart = 0;

const itemsCart = document.querySelector('#carrito-items');
const containerCartProducts = document.querySelector('.container-cart-products');
const FullCart = document.querySelector('#carrito-lleno');
const btnAddCart = document.querySelector('#btnAddCart');
const btnCart = document.querySelector('#btnCart');
const countProducts = document.querySelector('#contador-productos');

btnCart.addEventListener('click', () => {
    containerCartProducts.classList.toggle('hidden-cart');
});

window.onscroll = () => {
    searchBar.classList.remove('active');
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
    loginForm.classList.remove('active');
}

menu.addEventListener('click', () => {
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
});

formBtn.addEventListener('click', () => {
    loginForm.classList.add('active');
});

formClose.addEventListener('click', () => {
    loginForm.classList.remove('active');
});

videoBtn.forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelector('.controls .active').classList.remove('active');
        btn.classList.add('active');
        let src = btn.getAttribute('data-src');
        document.querySelector('#video-slider').src = src;
    });
});

var swiper = new Swiper(".mySwiper", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

// ------------------------- Sección de Carrito -------------------------

// Variable de arreglo de productos en el carrito
let contentCart = [];
let countProductsCart = 0;

function listItemsCart() {
    var html = '';
    totalCart = 0;

    itemsCart.innerHTML = '';

    for (var i = 0; i < contentCart.length; i++) {
        var product = contentCart[i];

        // Verificar si el producto es válido
        if (product && product.precio && product.titulo) {
            var precio = product.precio;
            var titulo = product.titulo;

            // Aumentar total carrito.
            totalCart = totalCart + parseInt(precio);

            // Añadir item al carrito.
            html += '<div id="cart-' + i + '" class="row-product">';
            html += '<div class="cart-product">';
            html += '<div class="info-cart-product">';
            html += '<span style="cursor: pointer"><i class="delete-item fa-solid fa-trash" data-item="' + i + '" data-precio="' + precio + '"></i></span>';
            html += '<p class="titulo-producto-carrito">' + titulo + '</p>';
            html += '<span class="precio-producto-carrito">$ ' + precio + '</span> ';
            html += '</div>';
            html += '<svg';
            html += 'xmlns="http://www.w3.org/2000/svg"';
            html += 'fill="none"';
            html += 'viewBox="0 0 24 24"';
            html += 'stroke-width="1.5"';
            html += 'stroke="currentColor"';
            html += 'class="icon-close"';
            html += '>';
            html += '<path';
            html += 'stroke-linecap="round"';
            html += 'stroke-linejoin="round"';
            html += 'd="M6 18L18 6M6 6l12 12"';
            html += '/>';
            html += '</svg>';
            html += '</div>';
            html += '</div>';
        } else {
            console.error('Producto inválido en contentCart:', product);
        }
    }

    document.querySelector('#total-pagar').innerHTML = '$' + totalCart;
    itemsCart.innerHTML = html;

    // Se muestra el carrito.
    document.querySelector('#carrito-vacio').classList.add('hidden');
    FullCart.classList.remove('hidden');

    if (countProductsCart == 0) {
        // Restar el carrito
        totalCart = 0;
        document.querySelector('#total-pagar').innerHTML = '$' + totalCart;

        document.querySelector('#carrito-vacio').classList.remove('hidden');
        FullCart.classList.add('hidden');
    }
}

// Manejo de eventos para eliminar productos del carrito
$(document).on('click', '.delete-item', function (elem) {
    // Decrementar el contador.
    countProductsCart = countProductsCart - 1;
    countProducts.innerHTML = countProductsCart;

    // Obtener los datos.
    var id = elem.target.getAttribute('data-item');
    var precio = elem.target.getAttribute('data-precio');
    var item = document.querySelector('#cart-' + id);

    delete contentCart[id];

    var filtered = contentCart.filter(function (el) {
        return el != null;
    });

    localStorage.clear();
    localStorage.setItem('cart', JSON.stringify(filtered));

    // Restar el carrito
    totalCart = totalCart - parseInt(precio);
    document.querySelector('#total-pagar').innerHTML = '$' + totalCart;

    // Remover item del carrito.
    item.remove();

    if (countProductsCart == 0) {
        // Restar el carrito
        totalCart = 0;
        document.querySelector('#total-pagar').innerHTML = '$' + totalCart;

        document.querySelector('#carrito-vacio').classList.remove('hidden');
        FullCart.classList.add('hidden');
    }
});

// ------------------------- Fin Sección de Carrito -------------------------

// Recuperar el carrito del localStorage
var myCart = localStorage.getItem('cart');

if (myCart == null) {
    // No se ha creado un carrito todavía.
    contentCart = [];
    countProductsCart = 0;
} else {
    // Si se ha creado un carrito, cargarlo.
    contentCart = JSON.parse(localStorage.getItem('cart'));
    countProductsCart = contentCart.length;

    // Actualizar la vista del carrito
    listItemsCart();
}

// Actualizar el contador de productos
countProducts.innerHTML = countProductsCart;
