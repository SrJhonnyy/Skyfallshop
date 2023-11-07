let totalCart = 0;
const itemsCart = document.querySelector('#box-container');
function listItemsCart() {x|
    var html = '';
    totalCart = 0;

    itemsCart.innerHTML = '';

    for(var i = 0; i < contentCart.length; i++){
        var precio = contentCart[i].precio;
        var titulo = contentCart[i].titulo;
        var descripcion = contentCart[i].descripcion;

        // Aumentar total carrito.
        totalCart = totalCart + parseInt(precio);

        // Añadir item al carrito.
        html+='<div class="box">';
            html+='<img src="{{ asset('img/destinos/')}}" alt="">';
            html+='<div class="content">';
                html+='<h3> <i class="titulo-producto-carrito"></i>' + titulo + '</h3>';
                html+='<p class="text-justify">' + descripcion + '</p>';
                html += '<span class="precio-producto-carrito">$ ' + precio + '</span> ';
            html+='</div>';
        html+='</div>';
    
    }

}   
document.querySelector('#total-pagar').innerHTML = '$' + totalCart;
itemsCart.innerHTML = html;