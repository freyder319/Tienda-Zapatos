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