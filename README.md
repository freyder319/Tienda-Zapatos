# Tienda-computadores y repuestos

Sistema web para la gestión de una tienda de computadores y repuestos. Incluye un catálogo de productos, sistema de compras para clientes, y una zona administrativa para la gestión de productos, categorías y pedidos.

---

## Funcionalidades

### Cliente
- Registro e inicio de sesión.
- Visualización del catálogo de productos.
- Agregar productos al carrito.
- Realizar compras.

### Administrador
- Gestión de productos (crear, editar, eliminar, visualizar).
- Gestión de categorías.
- Visualización de pedidos y cambio de su estado.

---

##  Tecnologías Utilizadas

- HTML
- CSS
- JavaScript
- PHP
- Bootstrap
- MySQL
- Arquitectura MVC
- Programación Orientada a Objetos (POO)

---

## Estructura del Proyecto

- `Modelo/` – Clases que contienen las consultas SQL, métodos y atributos.
- `Controlador/` – Lógica del negocio, conexión entre modelo y vista.
- `Vista/` – Archivos HTML, CSS, JavaScript, imágenes y componentes visuales.
- `index.php` – Archivo principal que carga la vista inicial y comunica con el controlador.

---

## Instalación y Ejecución

### 1. Requisitos Previos

- [XAMPP](https://www.apachefriends.org/es/index.html) o similar.
- PHP 7.4+ y MySQL.
- Git instalado.

### 2. Clonar el Repositorio

```bash
# Crear carpeta en htdocs de XAMPP
cd /ruta/a/htdocs
mkdir tienda-zapatos
cd tienda-zapatos

# Clonar repositorio (usando Git Bash)
git clone https://github.com/freyder319/perubea.git .
```
### 3. Iniciar XAMPP
- Inicia los servicios Apache y MySQL desde el panel de XAMPP.
### 4. Importar la Base de Datos
-Accede a phpMyAdmin.
-Crea una nueva base de datos (ej. tienda_zapatos).
-Importa el archivo Script.sql incluido en el proyecto.
### 5. Acceder al sitio
-Abre tu navegador y ve a http://localhost/tienda-zapatos.
## Accesos de Prueba
### Administrador
-Correo: admin@gmail.com
-Contraseña: admin
### cliente
-Registrarse con un correo y contraseña desde la página principal.
## Metodologia de Desarrollo 
-MVC: Separación clara entre lógica (modelo), presentación (vista) y controladores.
-POO: Uso de clases y objetos para encapsular la lógica del sistema.
