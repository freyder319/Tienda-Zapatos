<!-- index.html -->
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda de Tenis</title>
  <link rel="stylesheet" href="vista/css/style.css">
</head>
<body>
  <header>
    <h1>Tienda de Tenis</h1>
    <nav>
      <a href="index.php?action=verInicio">Inicio</a>
      <a href="index.php?action=verInicio">Catálogo</a>
      <?php
        if (isset($_SESSION["rol"])&& $_SESSION["rol"]=="admin"){
        ?>
        <a href="index.php?action=verProducto">Productos</a>
        <a href="index.php?action=verCategoria">Categorias</a>
        <a href="index.php?action=verPedidos">Pedidos</a>
        <?php
      }else{
        ?>
        <a href="index.php?action=verAdministracion">Zona Admin</a>
        <?php
      }
      
      if (isset($_SESSION["rol"])){?>
        <a href="index.php?action=cerrarSesion">Cerrar Sesión</a>
<?php
      }else{
        ?>
        <a href="index.php?action=verRegistro">Registrarse</a>
        <?php
      }
      
      ?>
    </nav>
  </header>

  <section id="admin">
    <h2>Pedido:</h2>
    <p><strong>Cantidad de producto que quieres pedir:</strong></p>
    <form action="index.php?action=agregarPedido" method="post">
        <input type="hidden" value="<?php echo $id ?>" id="idProducto" name="idProducto">
        <input type="hidden" value="<?php echo $_SESSION["id_usuario"] ?>" id="idUsuario" name="idUsuario">
        <input type="text" placeholder="cantidad" id="cantidad" name="cantidad" required>
      <button type="submit">Ingresar</button>
    </form>
  </section>
  <footer>
    <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
  </footer>
</body>
</html>
