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

  <?php
  if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "admin") {
    if ($_SESSION["rol"] == "admin") {
      ?>
      <section id="panel-admin">
        <h2>Panel de Administración</h2>
        <div class="admin-section">
          <h3>Categorías</h3>
          <?php
          if (isset($categoriaxid)) {
            $fila3 = $categoriaxid->fetch_assoc();
            ?>
            <form class="form-admin" action="index.php?action=guardarCategoriaNueva" method="post">
              <input type="hidden" value="<?php echo $fila3["id"] ?>" id="idCategoria" name="idCategoria">
              <input type="text" value="<?php echo $fila3["nombre"] ?>" id="nombre" name="nombre">
              <button type="submit">Editar Categoria</button>
            </form>
            <?php
          } else {
            ?>
            <form class="form-admin" action="index.php?action=guardarCategoria" method="post">
              <input type="text" placeholder="Nombre de la categoría" id="nombre" name="nombre">
              <button type="submit">Guardar Categoría</button>
            </form>
            <?php
          }
          ?>
          <ul>
            <?php
            while ($fila2 = $categorias->fetch_assoc()) {
              ?>
              <li><?php echo $fila2["nombre"] ?>
                <a href="index.php?action=editarCategoria&id=<?php echo $fila2["id"]; ?>"><button>Editar</button></a>
                <a href="index.php?action=eliminarCategoria&id=<?php echo $fila2["id"]; ?>"><button>Eliminar</button></a>
              </li>
              <?php
            }

            ?>
          </ul>
        </div>
        <?php
    }
  } else { ?>
      <section id="admin">
        <h2>Zona Administrador</h2>
        <p><strong>Iniciar sesión:</strong></p>
        <form action="index.php?action=login" method="post">
          <input type="email" placeholder="Correo" id="correo" name="correo">
          <input type="password" placeholder="Contraseña" id="contrasena" name="contrasena">
          <button type="submit">Ingresar</button>
        </form>
      </section>

      <?php
  }



  ?>

    <footer>
      <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
    </footer>
</body>

</html>