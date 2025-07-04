<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tienda de Computadoras y Repuestos</title>
  <link rel="stylesheet" href="vista/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="Vista/jquery/jquery.js"></script>
  <script src="Vista/js/script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
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
      while ($img = $imagenes->fetch_assoc()) {
        $imagenes_array[] = $img;
      }
      if (isset($productos) && $productos->num_rows > 0) {
        while ($fila1 = $productos->fetch_assoc()) {
          ?>
          <div class="producto">
            <div id="carouselExample<?php echo $fila1["id_producto"] ?>" class="carousel slide">
              <div class="carousel-inner">
                <?php
                  $activa = true;

                  foreach ($imagenes_array as $fila2) {
                      if ($fila2["id_producto"] == $fila1["id_producto"]) {
                      echo "<div class='carousel-item " . ($activa ? 'active' : '') . "'>";
                      echo "<img src='uploads/{$fila2["nombre_archivo"]}' alt='...'>";
                      echo "</div>";
                      $activa = false;
                    }
                  }
                

                ?>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample<?php echo $fila1["id_producto"] ?>" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExample<?php echo $fila1["id_producto"] ?>" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
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