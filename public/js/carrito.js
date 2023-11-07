const cartEmpty = document.querySelector('.cart-empty');
const cartTotal = document.querySelector('.cart-total');

btnAddCart.addEventListener('click', function(){
    // Incrementar el contador.
    countProductsCart = countProductsCart + 1;
    countProducts.innerHTML = countProductsCart;

    // Obtener los datos.
    var id = document.querySelector('#destino-id').getAttribute('data-id');
    var imagen = document.querySelector('#destino-imgen').getAttribute('data-imagen');
    var titulo = document.querySelector('#destino-titulo').getAttribute('data-titulo');
    var descripcion = document.querySelector('#destino-descripcion').getAttribute('data-descripcion');
    var precio = document.querySelector('#destino-precio').getAttribute('data-precio');

    var nuevoItem = {
        id: id,
        imagen: imagen,
        titulo: titulo,
        descripcion: descripcion,
        precio: precio,
    };

    contentCart.push(nuevoItem);
    localStorage.clear();
    localStorage.setItem('cart', JSON.stringify(contentCart));

    listItemsCart();
});