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
            <h3>Carrito</h3>

            <?php if (isset($carritoCliente) && count($carritoCliente) > 0) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nombre producto</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Cantidad</th>
                            <th>Precio por unidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($carritoCliente as $producto) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($producto["nombre"]); ?></td>
                                <td><?php echo htmlspecialchars($producto["marca"]); ?></td>
                                <td><?php echo htmlspecialchars($producto["modelo"]); ?></td>
                                <td><?php echo htmlspecialchars($producto["cantidad"]); ?></td>
                                <td><?php echo htmlspecialchars($producto["precio"]); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">Total</td>
                            <td>
                                <?php
                                $total = 0;
                                foreach ($carritoCliente as $producto) {
                                    $total += $producto["precio"] * $producto["cantidad"];
                                }
                                echo htmlspecialchars($total);
                                ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            <?php } else { ?>
                <table>
                    <tr>
                        <td colspan="2">No hay productos registrados.</td>
                    </tr>
                </table>
            <?php } ?>
            <table>
                <tr>
                    <td>
                        <form action="index.php?action=confirmarPedido" method="post" style="display: inline;">
                            <input type="hidden" name="idCliente">
                            <button type="submit">Confirmar pedido</button>
                        </form>
                    </td>
                    <td>
                        <form action="index.php?action=eliminarCarrito" method="post" style="display: inline; ">
                            <input type="hidden" name="idCliente">
                            <button type="submit">Eliminar Carrito</button>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
    </footer>
</body>

</html>