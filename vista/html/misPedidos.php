<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Tenis</title>
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
        <h1>Tienda de Tenis</h1>
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
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php while ($fila4 = $pedidosCliente->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $fila4["pedido_id"] ?></td>
                                <td><?php echo $fila4["nombre_producto"] ?></td>
                                <td><?php echo $fila4["cantidad"] ?></td>
                                <td><?php echo $fila4["fecha"] ?></td>
                                <td><?php echo $fila4["estado"] ?></td>
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