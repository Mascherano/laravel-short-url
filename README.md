## Proyecto acortador de url's para ML

Hola, acá les dejo una guía con los pasos necesarios para ejecutar el proyecto en algún pc o les dejare una lista con las carpetas y archivos que contienen el código creado
para el acortador de url's.

## Para instalar

- Deben tener instalado php 8 o superior, pueden usar xampp, wamp o laragon.
- Deben tener instalado composer para gestionar las librerías que utilizada la aplicación.
- Deben tener instalado mySQL para gestionar la base de datos.
- Deben tener instalado node y npm

## Para descargar proyecto

- Ubicarse dentro de la carpeta que ejecuta los proyectos en wamp, laragon o xampp
- para clonar el proyecto -> git clone https://github.com/Mascherano/laravel-short-url.git
- Cambiar nombre del archivo .env.example a .env
- Utilizar variables de conexión a mysql que tiene el archivo .env

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombredebasecreada
    DB_USERNAME=nombredeusaurio
    DB_PASSWORD=clavedeusuario

- Crear base de datos en mysql y dejar vacia, sin tablas creadas.
- Ejecutar "composer install" dentro de la carpeta base del proyecto, esto descargara todas las dependencias del proyecto.
- Ejecutar "php artisan migrate" dentro de la carpeta base del proyecto, este comando creara las tablas necesarias para utilizar el proyecto.
- Ejecutar "npm run dev" dentro de la carpeta base del proyecto.

## Para revisar código.

- Dentro de app/Http/Controllers/

- Archivo UrlManagerController.php -> contiene funciones para: 

    - Validar formato de url larga entregada.
    - entregar código corto.
    - revisar tamaño de código corto entregado.
    - Revisar si url larga entregada existe en bd.
    - Revisar si código corto entregado existe en bd.
    - Guardar url larga entregada, código corto generado.

- Archivo ShortUrlController.php -> contine funciones para:

    - Recibir url larga y entregar url corta generada desde formulario.
    - Recibir url corta y entregar url larga desde formulario.
    - Redireccionar a url larga cuando en el navegador se recibe url corta.
    - Eliminar url corta y larga de la bd desde tabla creada en vista principal.

- Archivo ApiShortUrlController.php -> contine funciones para:

    - Recibir url larga y entregar url corta generada desde api, require token creado.
    - Recibir url corta y entregar url larga desde api, requiere token creado.
    - Eliminar url corta y larga de la bd desde tabla creada en vista principal, requiere token creado.

- Dentro de app/Http/Controllers/Api/

- Archivo AutenticarController.php -> contiene funciones para:

    - Registrar usuarios desde api
    - iniciar sesión desde api a traves de tokens
    - cerrar sesión desde api, requiere token

- Dentro de resources/views/

- Archivo dashboard.blade.php -> contiene:

    - Formulario que recibe url larga y entrega url corta.
    - Formulario que recibe url corta y entrega url larga.
    - Tabla con las url's almacenadas (largas y cortas) y permite redireccionar a url larga desde la url corta y eliminar datos.
