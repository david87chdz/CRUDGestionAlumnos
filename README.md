# CRUD GestionAlumnos
# Sistema CRUD para Gestión de Proyectos - PHP

Este es un sistema CRUD (Create, Read, Update, Delete) desarrollado en PHP para la gestión de proyectos de alumnos y profesores asignados a estos proyectos.

## Funcionalidades

- **Crear Proyecto**: Permite añadir nuevos proyectos al sistema.
- **Ver Proyectos**: Muestra una lista de todos los proyectos existentes con detalles relevantes.
- **Actualizar Proyecto**: Permite modificar la información de un proyecto existente.
- **Eliminar Proyecto**: Permite eliminar un proyecto del sistema.

## Requisitos

- PHP 7.x o superior
- Servidor web (Apache, Nginx, etc.)
- MySQL o MariaDB (para almacenamiento de datos)

## Instalación

1. Clona o descarga el repositorio en tu servidor web:

   ```bash
   git clone https://github.com/tu_usuario/crud-php-proyectos.git

2.Configura la conexión a la base de datos editando el archivo [`Controlador/Config/biblioteca.php`](./Controlador/Config/biblioteca.php) y ajustando los parámetros de conexión:
```bash
<?php
$host = 'localhost';
$username = 'tu_usuario_db';
$password = 'tu_contraseña';
$database = 'nombre_de_tu_base_de_datos';
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```
3.Importa la estructura de la base de datos desde el archivo SQL proporcionado [`database.sql`](./Controlador/Dump/database.sql).

4.Inicia tu servidor web y abre el sistema en tu navegador.
