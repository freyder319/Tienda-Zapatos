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
  <section id="admin">
    <h2>Zona login</h2>
    <p><strong>Iniciar sesión:</strong></p>
    <form action="index.php?action=login" method="post">
      <input type="email" placeholder="Correo" id="correo" name="correo">
      <input type="password" placeholder="Contraseña" id="contrasena" name="contrasena">
      <button type="submit">Ingresar</button>
    </form>
  </section>

  <footer>
    <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
  </footer>
</body>

</html>