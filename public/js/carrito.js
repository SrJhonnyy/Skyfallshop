// Manejo de eventos para agregar productos al carrito
const btnsAddToCart = document.querySelectorAll('.btn-add-to-cart');

btnsAddToCart.forEach(btn => {
    btn.addEventListener('click', function () {
        // Incrementar el contador de productos en el carrito
        countProductsCart = countProductsCart + 1;
        countProducts.innerHTML = countProductsCart;

        // Obtener los datos del producto a agregar al carrito
        var id = btn.getAttribute('data-product-id');
        var imagen = btn.getAttribute('data-product-imagen');
        var titulo = btn.getAttribute('data-product-titulo');
        var descripcion = btn.getAttribute('data-product-descripcion');
        var precio = btn.getAttribute('data-product-precio');

        // Crear un nuevo objeto representando el producto
        var nuevoItem = {
            id: id,
            imagen: imagen,
            titulo: titulo,
            descripcion: descripcion,
            precio: precio,
        };

        // Agregar el nuevo producto al carrito
        contentCart.push(nuevoItem);

        // Limpiar y actualizar el almacenamiento local con el carrito actualizado
        localStorage.clear();
        localStorage.setItem('cart', JSON.stringify(contentCart));

        // Actualizar la vista del carrito
        listItemsCart();
    });
});

// Manejo de eventos para eliminar productos del carrito
$(document).on('click', '.delete-item', function (elem) {
    // Decrementar el contador.
    countProductsCart = countProductsCart - 1;
    countProducts.innerHTML = countProductsCart;

    // Obtener el índice del producto en el carrito.
    var id = elem.target.getAttribute('data-item');
    var precio = elem.target.getAttribute('data-precio');
    var item = document.querySelector('#cart-' + id);

    // Eliminar el producto del carrito.
    contentCart.splice(id, 1);

    // Actualizar el localStorage con el carrito actualizado.
    localStorage.setItem('cart', JSON.stringify(contentCart));

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
    // ...

// Manejo de eventos para reiniciar el carrito
document.getElementById('reset-cart-btn').addEventListener('click', function () {
    console.log('Botón "Reiniciar Carrito" hace clic');

    countProductsCart = 0;
    countProducts.innerHTML = countProductsCart;

    // Limpiar el contenido del carrito
    contentCart = [];

    // Limpiar y actualizar el almacenamiento local con el carrito vacío
    localStorage.clear();
    localStorage.setItem('cart', JSON.stringify(contentCart));

    // Actualizar la vista del carrito
    listItemsCart();
});
});