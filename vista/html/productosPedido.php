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
        <h2>Productos del pedido numero: <?php echo $_GET["idPedido"] ?></h2>
        <div class="admin-section">
            <?php if (isset($productosPedido) && $productosPedido->num_rows > 0) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio unitario</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($fila = $productosPedido->fetch_assoc()) {
                            ?>
                            <tr>
                                <td><?php echo $fila["nombre_producto"]; ?></td>
                                <td><?php echo $fila["precio_unitario"]; ?></td>
                                <td><?php echo $fila["cantidad"]; ?></td>
                                <td><?php echo $fila["subtotal"]; ?></td>
                            </tr>
                            <?php
                        }
            }
            ?>
                </tbody>
            </table>
            </table>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
    </footer>
</body>

</html>