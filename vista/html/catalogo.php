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
  if (isset($_GET["mensaje"])) {
    if ($_GET["mensaje"] == 1) {
      echo ("<script>alert('Pedido realizado exitosamente.')</script>");
      ?>
      <script>window.location.href = "index.php?action=verInicio";</script>
      <?php
    }
  }
  ?>

  <header>
    <h1>Tienda de Computadoras y Repuestos</h1>
    <div id="nav"></div>
  </header>
  <?php
  ?>
  <form action="index.php?action=filtrarCategoria" method="post">
    <label for="categoria">Filtrar por categoría:</label>
    <select name="categoria" id="categoria">
      <option value="">Todas</option>
      <?php
      while ($cat = $categorias->fetch_assoc()) {
        echo "<option value='" . $cat["id"] . "'>" . $cat["nombre"] . "</option>";
      }
      ?>
    </select>
    <input type="submit" value="Filtrar">
  </form>

  <section id="catalogo">
    <h2>Catálogo de Productos</h2>
    <div class="productos">
      <?php
      if (isset($productos) && $productos->num_rows > 0) {

        while ($fila1 = $productos->fetch_assoc()) {
          if (!isset($fila1["imagen"]) || $fila1["imagen"] == NULL) {
            $rutaImagen = "vista/imagenes/sinFoto.jpg";
          } else {
            $rutaImagen = "uploads/" . $fila1["imagen"];
          }
          ?>
          <div class="producto">
            <img src="<?php echo $rutaImagen; ?>">
            <h3><?php echo $fila1["nombre"]; ?></h3>
            <p>Especificacion:<?php echo $fila1["especificaciones"]; ?></p>
            <p>Marca: <?php echo $fila1["marca"]; ?></p>
            <p>Tipo: <?php echo $fila1["nombre_categoria"]; ?></p>
            <p> $<?php echo $fila1["precio"]; ?></p>
            <?php
            if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "cliente") {
              ?>
              <a href="index.php?action=realizarPedido&id=<?php echo $fila1["id_producto"] ?>"><button>Agregar al
                  carrito</button></a>
              <?php
            } else {
              ?>
              <p>Registrese para realizar un pedido.</p>
              <?php
            }
            ?>
          </div>
          <?php
        }
      } else {
        ?>
        <div class="producto">
          <h3>Aun no hay productos disponibles.</h3>
        </div>
        <?php
      } ?>
    </div>
  </section>

  <footer>
    <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
  </footer>
</body>

</html>