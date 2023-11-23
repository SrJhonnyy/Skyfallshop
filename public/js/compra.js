let totalCart = 0;
const itemsCart = document.querySelector('#box-container');

function listItemsCart() {
    var html = '';
    totalCart = 0;

    for (var i = 0; i < contentCart.length; i++) {
        var precio = contentCart[i].precio;
        var titulo = contentCart[i].nombre;  // Cambiado de 'titulo' a 'nombre'
        var descripcion = contentCart[i].descripcion;

        // Aumentar total carrito.
        totalCart = totalCart + parseInt(precio);

        // Añadir item al carrito.
        html += '<div class="box">';
        html += '<img src="{{ asset("img/destinos/") }}/' + contentCart[i].id + '/principal.jpg" alt="">';
        html += '<div class="content">';
        html += '<h3> <i class="titulo-producto-carrito"></i>' + titulo + '</h3>';
        html += '<p class="text-justify">' + descripcion + '</p>';
        html += '<span class="precio-producto-carrito">$ ' + precio + '</span> ';
        html += '</div>';
        html += '</div>';
    }

    // Establecer el HTML dentro del elemento itemsCart
    itemsCart.innerHTML = html;

    // Actualizar el total del carrito
    document.querySelector('#total-pagar').innerHTML = '$' + totalCart;
}

function addToCart(id, nombre, precio, descripcion) {
    // Asumiendo que contentCart es un arreglo global que almacena los productos en el carrito
    contentCart.push({ id: id, nombre: nombre, precio: precio, descripcion: descripcion });

    // Después de agregar al carrito, actualiza la vista del carrito
    listItemsCart();
}


// Llamada a la función para listar los productos en el carrito
listItemsCart();

document.addEventListener('DOMContentLoaded', function () {
    const addToCartButtons = document.querySelectorAll('.btn-add-to-cart');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = button.getAttribute('data-product-id');
            const productName = button.getAttribute('data-product-name');
            const productPrice = button.getAttribute('data-product-price');
            const productDescription = button.getAttribute('data-product-description');

            // Llama a la función addToCart con los datos del producto
            addToCart(productId, productName, productPrice, productDescription);
        });
    });
});
