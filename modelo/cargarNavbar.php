<?php
session_start();
if (isset($_SESSION['rol'])) {
    switch ($_SESSION['rol']) {
        case 'admin':
            ?>
            <nav>
                <a href="index.php?action=verInicio">Inicio</a>
                <a href="index.php?action=verInicio">Catálogo</a>
                <a href="index.php?action=verProducto">Productos</a>
                <a href="index.php?action=verCategoria">Categorias</a>
                <a href="index.php?action=verPedidos">Pedidos</a>
                <a href="index.php?action=cerrarSesion">Cerrar Sesión</a>
            </nav>
            <?php
            break;
        case 'cliente':
            ?>
            <nav>
                <a href="index.php?action=verInicio">Inicio</a>
                <a href="index.php?action=verInicio">Catálogo</a>
                <a href="index.php?action=verCarrito">Carrito</a>
                <a href="index.php?action=verMisPedidos">Mis pedidos</a>
                <a href="index.php?action=cerrarSesion">Cerrar Sesión</a>
            </nav>
            <?php
            break;
    }
} else {
    ?>
    <nav>
        <a href="index.php?accion=inicio">Inicio</a>
        <a href="index.php?accion=inicio">Catálogo</a>
        <a href="index.php?action=verRegistro">Registrarse</a>
        <a href="index.php?action=verAdministracion">Zona login</a>
    </nav>
    <?php
}