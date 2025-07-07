$(document).ready(function () {
    cargarNav();
});

function cargarNav() {
    $.post("modelo/cargarNavbar.php", {}, function (respuesta) {
        $("#nav").html(respuesta);
    })
}

function confirmarEliminarProductoCarrito(idProducto) {
    if (confirm("¿Está seguro de que desea eliminar este producto del carrito?")) {
        window.location.href = "index.php?action=eliminarProductoCarrito&idProducto=" + idProducto;
    }
}

function confirmarEliminarCarrito() {
    if (confirm("¿Está seguro de que desea eliminar todo el carrito?")) {
        window.location.href = "index.php?action=eliminarCarrito";
    }
}

function confirmarCerrarSesion() {
    if (confirm("¿Está seguro de querer cerrar sesión?"))
        window.location.href = "index.php?action=cerrarSesion";
}

function confirmarCancelarPedido(idPedido) {
    if (confirm("¿Está seguro de que desea cancelar este pedido?")) {
        window.location.href = "index.php?action=cancelarPedido&idPedido=" + idPedido;
    }
}