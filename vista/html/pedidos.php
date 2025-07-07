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
          <h3>Pedidos</h3>
          <?php if (isset($pedidos) && $pedidos->num_rows > 0) { ?>
            <table>
              <thead>
                <tr>
                  <th>ID Pedido</th>
                  <th>Cliente</th>
                  <th>Fecha</th>
                  <th>Estado</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($fila4 = $pedidos->fetch_assoc()) {
                  ?>
                  <tr>
                    <td><?php echo $fila4["pedido_id"] ?></td>
                    <td><?php echo $fila4["nombre_usuario"] ?></td>
                    <td><?php echo $fila4["fecha"] ?></td>
                    <td><?php echo $fila4["estado"] ?></td>
                    <td><?php if ($fila4["estado"] == "Completado") {
                      echo "Completado";
                    } else {
                      ?>
                        <form action='index.php?action=actualizarEstadoPedido' method='post'>
                          <input type='hidden' id="pedido_id" name='pedido_id' value="<?php echo $fila4["pedido_id"] ?>">
                          <select name='estado' id="estado">
                            <option <?php if ($fila4["estado"] == "Pendiente") {
                              echo "selected";
                            } ?> value='Pendiente'>Pendiente
                            </option>
                            <option <?php if ($fila4["estado"] == "Enviado") {
                              echo "selected";
                            } ?> value='Enviado'>Enviado
                            </option>
                            <option <?php if ($fila4["estado"] == "Completado") {
                              echo "selected";
                            } ?> value='Completado'>
                              Completado
                            </option>
                          </select>
                          <button type='submit'>Actualizar</button>
                        </form><?php
                    } ?>
                    </td>
                    <td><?php echo$fila4["total"] ?></td>
                  </tr>
                  <?php
                }
          } else { ?>
                <tr>
                  <td colspan="7">No hay pedidos registrados.</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </section>




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