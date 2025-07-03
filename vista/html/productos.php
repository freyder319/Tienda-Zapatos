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

  <?php
  if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "admin") {
    if ($_SESSION["rol"] == "admin") {
      ?>
      <section id="panel-admin">
        <h2>Panel de Administración</h2>

        <div class="admin-section">
          <h3>Productos</h3>
          <?php
          if (isset($productosxid)) {
            $fila3 = $productosxid->fetch_assoc();
            ?>
            <form class="form-admin" action="index.php?action=editarProductoxid" method="post" required
              enctype="multipart/form-data">
              <input type="hidden" value="<?php echo $fila3["id_producto"] ?>" id="idProducto" name="idProducto">
              <input type="text" value="<?php echo $fila3["nombre"] ?>" id="nombre" name="nombre" required>
              <input type="text" value="<?php echo $fila3["especificaciones"] ?>" id="descripcion" name="especificaciones" required>
              <input type="number" value="<?php echo $fila3["precio"] ?>" id="precio" name="precio" required>
              <input type="text" value="<?php echo $fila3["marca"] ?>" id="marca" name="marca" required>
              <input type="text" value="<?php echo $fila3["modelo"] ?>" id="modelo" name="modelo" required>
              <select id="categoria" name="categoria" required>
                <option value="">Seleccionar categoría</option>
                <?php
                while ($fila2 = $categoriasSelect->fetch_assoc()) {
                  ?>
                  <option <?php if ($fila3["id_categoria"] == $fila2["id"]) {
                    echo "selected";
                  } ?> value="<?php echo $fila2["id"] ?>"><?php echo $fila2["nombre"] ?></option>
                  <?php
                }
                ?>
              </select>
              <input id="cover" class="upload" name="cover" type="file">
              <button type="submit">Editar Producto</button>
            </form>
            <?php
          } else {
            ?>
            <form class="form-admin" action="index.php?action=guardarProducto" method="post" required required
              enctype="multipart/form-data">
              <input type="text" placeholder="Nombre del producto" id="nombre" name="nombre" required>
              <input type="text" placeholder="Especificacion de Producto" id="especificacion" name="especificacion" required>
              <input type="number" placeholder="Precio" id="precio" name="precio" required>
              <input type="text" placeholder="Marca" id="talla" name="marca" required>
              <input type="text" placeholder="Modelo" id="talla" name="modelo" required>
              <select id="categoria" name="categoria" required>
                <option value="">Seleccionar Tipo</option>
                <?php
                while ($fila2 = $categoriasSelect->fetch_assoc()) {
                  ?>
                  <option value="<?php echo $fila2["id"] ?>"><?php echo $fila2["nombre"] ?></option>
                  <?php
                }
                ?>
              </select>
              <input id="cover" class="upload" name="cover[]" type="file" multiple>
              <button type="submit">Guardar Producto</button>
            </form>
            <?php
          }

          ?>
          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while ($fila = $productos->fetch_assoc()) {
                ?>
                <tr>
                  <td><?php echo $fila["id_producto"] ?></td>
                  <td><?php echo $fila["nombre"] ?></td>
                  <td><?php echo $fila["nombre_categoria"] ?></td>
                  <td><?php echo $fila["precio"] ?></td>
                  <td><?php echo $fila["modelo"] ?></td>
                  <td><?php echo $fila["marca"] ?></td>
                  <td>
                    <a href="index.php?action=editarProducto&id=<?php echo $fila["id_producto"] ?>">Editar</a>
                    <a href="index.php?action=eliminarProducto&id=<?php echo $fila['id_producto']; ?>"
                      onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?');"><button
                        type="button">Eliminar</button></a>

                  </td>
                </tr>

                <?php
              }

              ?>
            </tbody>
          </table>
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