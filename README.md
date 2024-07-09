# Prueba tecnica PHP Varcreative
La prueba consiste en crear un sistema básico de ABM (Alta, Baja, Modificación) para gestionar una lista de usuarios utilizando Programación Orientada a Objetos (POO).

## Requisitos

- PHP 7.x o superior

- Servidor web (Apache, Nginx, etc.)

- Base de datos MySQL

## Objetivos

Debes desarrollar una pequeña aplicación web que permita realizar las siguientes operaciones:

Crear Usuario: Un formulario para agregar un nuevo usuario con los campos `nombre` y `email`.
Listar Usuarios: Una página que muestre una lista de todos los usuarios existentes.
Actualizar Usuario: Un formulario para editar la información de un usuario existente.
Eliminar Usuario: Opción para eliminar un usuario de la lista.
 
## Estructura del Proyecto

Te sugerimos organizar tu proyecto de la siguiente manera:

/abm-usuarios
|-- /config
|   |-- database.php
|-- /classes
|   |-- User.php
|   |-- UserManager.php
|-- /public
|   |-- index.php
|   |-- create_user.php
|   |-- update_user.php
|   |-- delete_user.php
|   |-- list_users.php
|-- /templates
|   |-- header.php
|   |-- footer.php
|-- .htaccess
|-- composer.json

## Detalles Técnicos

### Configuración de la Base de Datos

Debes crear una clase `Database` para gestionar la conexión a la base de datos en `config/database.php`.

### Clases

Crea las clases `User` y `UserManager` en la carpeta `classes`.

- User.php: Esta clase representará a un usuario y manejará las operaciones CRUD básicas.

- UserManager.php: Esta clase utilizará la clase `User` para gestionar las operaciones de usuario.

### Plantillas

Crea una carpeta `templates` que contenga los archivos `header.php` y `footer.php` para el encabezado y pie de página de las vistas.

### Vistas

Crea los archivos necesarios en la carpeta `public` para manejar las operaciones de usuario: `index.php`, `create_user.php`, `update_user.php`, `delete_user.php`, `list_users.php`.

### Archivo .htaccess

Incluye un archivo `.htaccess` para redirigir todas las solicitudes a `index.php` si es necesario.

## Instrucciones Adicionales

- La aplicación debe estar desarrollada utilizando principios de Programación Orientada a Objetos.

- Implementa un manejo de errores adecuado y asegúrate de validar los datos del usuario.

- Documenta tu código y explica brevemente tu enfoque y decisiones técnicas.

## Punto Extra

- Se valorara la realizacion de un LOGIN AL SISTEMA utilizando BD y/o cualquier mejora que el candidato sugiera.

## Entrega

Subir el proyecto a un repositorio git con la prueba.
