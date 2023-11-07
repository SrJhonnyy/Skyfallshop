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
    // console.log('Holis');
    containerCartProducts.classList.toggle('hidden-cart');
});

window.onscroll = () =>{
    // searchBtn.classList.remove('fa-times');
    searchBar.classList.remove('active');
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
    loginForm.classList.remove('active');
}

menu.addEventListener('click', () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
});


/* searchBtn.addEventListener('click', () =>{
    searchBtn.classList.toggle('fa-times');
    searchBar.classList.toggle('active');
}); */

formBtn.addEventListener('click', () =>{
    loginForm.classList.add('active');
});

formClose.addEventListener('click', () =>{
    loginForm.classList.remove('active');
});

videoBtn.forEach(btn =>{
    btn.addEventListener('click', ()=>{
        document.querySelector('.controls .active').classList.remove('active');
        btn.classList.add('active');
        let src = btn.getAttribute('data-src');
        document.querySelector('#video-slider').src = src;

    });
})

var swiper = new Swiper(".mySwiper", {
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
//////////////////////////////////////////////////////////////////////////////
  
  
  

  /* ========================= */
  const cartInfo = document.querySelector('.cart-product');
  const rowProduct = document.querySelector('.row-product');
  
  // Lista de todos los contenedores de productos
// const productsList = document.querySelector('.container-items');

// Variable de arreglos de Productos
let allProducts = [];

const valorTotal = document.querySelector('.total-pagar');

/* productsList.addEventListener('click', e => {
	if (e.target.classList.contains('btn-add-cart')) {
		const product = e.target.parentElement;

		const infoProduct = {
			quantity: 1,
			title: product.querySelector('h3').textContent,
			price: product.querySelector('p').textContent,
		};

		const exits = allProducts.some(
			product => product.title === infoProduct.title
		);

		if (exits) {
			const products = allProducts.map(product => {
				if (product.title === infoProduct.title) {
					product.quantity++;
					return product;
				} else {
					return product;
				}
			});
			allProducts = [...products];
		} else {
			allProducts = [...allProducts, infoProduct];
		}

		showHTML();
	}
}); */

/* rowProduct.addEventListener('click', e => {
	if (e.target.classList.contains('icon-close')) {
		const product = e.target.parentElement;
		const title = product.querySelector('p').textContent;

		allProducts = allProducts.filter(
			product => product.title !== title
		);

		console.log(allProducts);

		showHTML();
	}
}); */

// Funcion para mostrar  HTML
const showHTML = () => {
	if (!allProducts.length) {
		cartEmpty.classList.remove('hidden');
		rowProduct.classList.add('hidden');
		cartTotal.classList.add('hidden');
	} else {
		cartEmpty.classList.add('hidden');
		rowProduct.classList.remove('hidden');
		cartTotal.classList.remove('hidden');
	}
}

// Limpiar HTML
// rowProduct.innerHTML = '';

let total = 0;
let totalOfProducts = 0;

allProducts.forEach(product => {
    const containerProduct = document.createElement('div');
    containerProduct.classList.add('cart-product');

    containerProduct.innerHTML = `
        <div class="info-cart-product">
            <span class="cantidad-producto-carrito">${product.quantity}</span>
            <p class="titulo-producto-carrito">${product.title}</p>
            <span class="precio-producto-carrito">${product.price}</span>
        </div>
        <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="icon-close"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12"
            />
        </svg>
    `;

    rowProduct.append(containerProduct);

    total =
        total + parseInt(product.quantity * product.price.slice(1));
    totalOfProducts = totalOfProducts + product.quantity;
});

$(document).on('click', '.delete-item', function(elem) {
    // Incrementar el contador.
    countProductsCart = countProductsCart - 1;
    countProducts.innerHTML = countProductsCart;

    // Obtener los datos.
    var id = elem.target.getAttribute('data-item');
    var precio = elem.target.getAttribute('data-precio');
    var item = document.querySelector('#cart-' + id);

    delete contentCart[id];

    var filtered = contentCart.filter(function(el) {
        return el != null;
    });

    localStorage.clear();
    localStorage.setItem('cart', JSON.stringify(filtered));

    // Restar el carrito
    totalCart = totalCart - parseInt(precio);
    document.querySelector('#total-pagar').innerHTML = '$' + totalCart;

    // Remover item del carrito.
    item.remove();

    if(countProductsCart == 0) {
        // Restar el carrito
        totalCart = 0;
        document.querySelector('#total-pagar').innerHTML = '$' + totalCart;
        console.log('Holis');

        document.querySelector('#carrito-vacio').classList.remove('hidden');
        FullCart.classList.add('hidden');
    }
});

/* valorTotal.innerText = `$${total}`;
countProducts.innerText = totalOfProducts; */

// LOCALSTORAGE

/* localStorage.setItem('nombre', 'Sebas');

var miNombre = localStorage.getItem('nombre');

console.log(miNombre);   */

function listItemsCart() {
    var html = '';
    totalCart = 0;

    itemsCart.innerHTML = '';

    for(var i = 0; i < contentCart.length; i++){
        var precio = contentCart[i].precio;
        var titulo = contentCart[i].titulo;

        // Aumentar total carrito.
        totalCart = totalCart + parseInt(precio);

        // Añadir item al carrito.
        html += '<div id="cart-' + i + '" class="row-product">';
            html += '<div class="cart-product">';
                html += '<div class="info-cart-product">';
                    html += '<span style="cursor: po"><i class="delete-item fa-solid fa-trash" data-item="' + i + '" data-precio="' + precio + '"></i></span>';
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
    }

    document.querySelector('#total-pagar').innerHTML = '$' + totalCart;
    itemsCart.innerHTML = html;

    // Se muestra el carrito.
    document.querySelector('#carrito-vacio').classList.add('hidden');
    FullCart.classList.remove('hidden');

    if(countProductsCart == 0) {
        // Restar el carrito
        totalCart = 0;
        document.querySelector('#total-pagar').innerHTML = '$' + totalCart;
        console.log('Holis');

        document.querySelector('#carrito-vacio').classList.remove('hidden');
        FullCart.classList.add('hidden');
    }
}

var myCart = localStorage.getItem('cart');

if(myCart == null) {
     // No se ha creado un carrito todavía.
    var contentCart = [];
    var countProductsCart = 0;
} else {
    // Si se ha creado un carrito todavía.
    var contentCart = JSON.parse(localStorage.getItem('cart'));
    var countProductsCart = contentCart.length;
    
    listItemsCart();
}

countProducts.innerHTML = countProductsCart;

// localStorage.clear();