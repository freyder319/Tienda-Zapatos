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