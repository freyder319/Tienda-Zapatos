$(document).ready(function () {
    cargarNav();
});

function cargarNav() {
    $.post("modelo/cargarNavbar.php", {}, function (respuesta) {
        $("#nav").html(respuesta);
    })
}