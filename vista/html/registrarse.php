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
      <a href="index.php?action=verAdministracion">Zona Admin</a>
      <?php
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
    <h2>Zona Registro Clientes</h2>
    <p><strong>Registrarse:</strong></p>
    <form action="index.php?action=agregarUsuario" method="post">
        <input type="text" placeholder="Nombre" id="nombre" name="nombre" required>
      <input type="email" placeholder="Correo" id="correo" name="correo" required>
      <input type="password" placeholder="Contraseña" id="contrasena" name="contrasena" required>
      <button type="submit">Ingresar</button>
    </form>
  </section>
  <footer>
    <p>&copy; 2025 Tienda de Tenis. Todos los derechos reservados.</p>
  </footer>
</body>
</html>
