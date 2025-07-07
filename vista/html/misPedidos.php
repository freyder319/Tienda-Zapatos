<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Computadoras y Repuestos</title>
    <link rel="stylesheet" href="vista/css/style.css">
    <script src="Vista/jquery/jquery.js"></script>
    <script src="Vista/js/script.js"></script>
</head>

<body>
    <?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == 1) {
            echo ("<script>alert('Usuario no encontrado.')</script>");
            ?>
            <script>window.location.href = "index.php?action=verAdministracion";</script>
            <?php
        } elseif ($_GET["error"] == 2) {
            echo ("<script>alert('Contraseña Incorrecta.')</script>");
            ?>
            <script>window.location.href = "index.php?action=verAdministracion";</script>
            <?php
        }
    }
    ?>

    <header>
        <h1>Tienda de Computadoras y Repuestos</h1>
        <div id="nav"></div>
    </header>

    <section id="panel-admin">
        <h2>Panel de Administración</h2>
        <div class="admin-section">
            <h3>Mis Pedidos</h3>

            <?php if (isset($pedidosCliente) && $pedidosCliente->num_rows > 0) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID Pedido</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while ($fila4 = $pedidosCliente->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $fila4["pedido_id"] ?></td>
                                <td><?php echo $fila4["fecha"] ?></td>
                                <td><?php echo $fila4["estado"] ?></td>
                                <td><?php echo $fila4["total"] ?></td>
                                <?php
                                if ($fila4["estado"] == "Pendiente") {
                                    ?>
                                    <td>
                                        <a href="index.php?action=consultarProductosPedido&idPedido=<?php echo $fila4['pedido_id'] ?>">
                                            <button type="button">Ver productos</button></a>
                                        <button type="button" onclick="confirmarCancelarPedido(<?php echo $fila4['pedido_id'] ?>)">
                                            Cancelar pedido</button>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php }
            } else { ?>
                        <tr>
                            <td colspan="7">No hay pedidos registrados.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
    </footer>
</body>

</html>