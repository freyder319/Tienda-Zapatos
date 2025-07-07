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
  <header>
    <h1>Tienda de Computadoras y Repuestos</h1>
    <div id="nav"></div>
  </header>

  <section id="admin">
    <h2>Pedido:</h2>
    <p><strong>Cantidad de producto que quieres pedir:</strong></p>
    <form action="index.php?action=agregarProductoCarrito" method="post">
      <input type="hidden" value="<?php echo $idProducto ?>" id="idProducto" name="idProducto">
      <input type="text" placeholder="cantidad" id="cantidad" name="cantidad" required>
      <button type="submit">Agregar al carrito</button>
    </form>
  </section>
  <footer>
    <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
  </footer>
</body>

</html>