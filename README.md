# SoundWave Store 🎶 Trabajo Práctico Integrador

![Laravel](https://img.shields.io/badge/Laravel_13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP_8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)
![FilamentPHP](https://img.shields.io/badge/FilamentPHP-EBB304?style=for-the-badge&logo=laravel&logoColor=black)
![MariaDB](https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

> **Descripción:** Sistema de Comercio Electrónico de instrumentos musicales. Permite la gestión de Productos, carrito de compras y un panel de administración para gestionar el stock de los productos y los pedidos.



## 🚀 Características principales
* **Autenticación de Usuarios:** Registro, Inicio de sesión y roles diferenciados (cliente y administrador).
* **Catálogo de Productos:** Filtros por categoría, búsqueda en tiempo real y paginación.

* **Carrito de Compras:** Persistencia de productos, cálculo automático de totales e impuestos.

* **Gestión de Pedidos:** Pasarela de pago simulada con cambios de estado en tiempo real (`pending`, `processing`, `completed`).

* **Panel de Administración (Backoffice):** CRUD completo de productos, categorías, marcas y visualización de pedidos.


## 🚀 Stack Tecnológico

| Componente | Tecnología |
| :--- | :--- |
| **Backend** | Laravel 13 / PHP 8.4 |
| **Frontend (Cliente)** | Laravel Blade |
| **Frontend (Administracion)** | Filament v5|
| **Base de Datos** | MariaBD |


## 📂 Estructura de carpetas

- **app/** → Lógica principal de la aplicación (Controllers, Models, Policies, Providers).
- **bootstrap/** → Configuración inicial de Laravel.

- **config/** → Archivos de configuración del sistema.

- **database/** → Migraciones y seeders.

- **lang/** → Archivos de traducción.

- **public/** → Archivos accesibles públicamente (CSS, JS compilado, imágenes).

- **resources/** → Vistas Blade, archivos CSS y JS fuente.

- **routes/** → Definición de rutas (`web.php`, `console.php`).

- **storage/** → Logs, caché y archivos generados.

- **tests/** → Pruebas unitarias y funcionales.

- **vendor/** → Dependencias instaladas vía Composer.



## 📂 Estructura del Proyecto

El sistema se divide claramente en dos grandes módulos:

### A. Panel de Administración (`/admin`)
Toda la gestión interna está delegada a **Filament**.Este framework facilitó el armado de formularios, tablas y vistas mediante componentes reutilizables y reactivos conectados a los modelos. De base se utiliza **Soft Deletes** en todos los casos, salvo que se especifique lo contrario. Están aplicados cuadros de búsqueda, filtros y ordenación.

* **Marcas:** CRUD con desactivación (oculta la disponibilidad de la marca al cargar productos). La eliminación  está restringida: solo es posible si no hay productos asociados a la marca.
* **Categorías:** CRUD completo. Con sus validaciones de campos(no se puede repetir una categoría ya creada).
* **Productos:** CRUD completo. Con sus validaciones de campos(la mayoría obligatorios). La activación/desactivación de un producto cumple la finalidad de quitarlo de manera cómoda de la vista web y seguir teniendolo accesible en el panel de filament(sin aplicar filtros) para realizar cambios de detalles, stock, etc. El campo subtitle (reservado para modelo de producto) no se puede repetir, evitando asi carga de productos repetidos. Asimismo, solo la 1er imagen del producto es obligatoria.
* **Órdenes:** Visualización de las pedidos generados en el sitio, con los detalles de las transacciones(costos, cantidad de productos, medios de pago, estado) y el usuario asociado a ella. Solo puede modificarse el estado. No se permite el borrado para mantener de forma segura el historial (aun cuando ya no tenga cuenta activa el usuario que la realizó).
* **Usuarios:** Pueden visualizarse los usuarios registrados, datos básicos (apellido y nombre, correo electrónico), rol en la plataforma y, cuando corresponda (cliente), sus compras confirmadas (órdenes).
* **Consultas:** Bandeja de entrada centralizada para los mensajes enviados desde el frontend. Permite visualización, cambio de estado (leído/en revisión/resuelto) y eliminación(definitiva).

* **Validaciones:** Se implementan en algunos casos mediante Requests dedicados e importándolos (ej: Productos, Usuarios)  y en otros se maneja directamente por filament, que inyecta validaciones tanto desde el frontend como el backend (ej: Marcas, Categorías).

* **Políticas:** Se ha implementado una clase dedicada al manejo de las autorizaciones para el modelo User en filament (aplica automáticamente) para bloquear,por ej., edición de perfiles, roles y/o eliminación de cuentas por parte del administrador.

### B. Sitio Frontend (Público)
Desarrollado con vistas **Blade** tradicionales y controladores optimizados para la experiencia del cliente:

* **Navegación y Vistas:** Controladores encargados de renderizar el inicio, el catálogo completo de productos, detalles de la empresa y la sección de contacto.

* **Autenticación:** Sistema completo de registro y logueo seguro de usuarios.

* **Perfil de Usuario:** Panel privado para el cliente con un controlador dedicado a la actualización de sus datos personales.

* **Carrito de Compras:** Lógica manual implementada para la selección, acumulación, persistencia y gestión de los instrumentos que el usuario desea adquirir.

* **Envío de Consultas:** Controlador especializado en recibir los formularios de contacto y derivarlos en tiempo real a la bandeja de Filament.



## 🔒 Lógica de Negocio y Seguridad

* **Middleware de Usuario:** Se implementó un middleware personalizado asociado al modelo `User` según rol (aparte de la autenticación) para proteger rutas específicas y gestionar de forma estricta los accesos y permisos dentro del flujo de compra y edición de perfil.

* **Form Requests Dedicados:** Las validaciones de datos están centralizadas y completamente aisladas de los controladores utilizando clases `Request` de Laravel. Esto mantiene el código limpio y asegura la integridad en procesos críticos como:
  * Formulario de consultas de contacto.
  * Autenticación (Login y Registro).
  * Actualización de perfil de usuario.


## 🎨 Interfaz de Usuario (UI) y Estilos

* **SweetAlert2:** Integrado para proporcionar un feedback interactivo, elegante y amigable al usuario tras realizar acciones clave (ej. confirmación de registro de cuenta, envío exitoso de consultas o alertas del carrito).
* **Animate.css:** Utilizado de forma precisa para añadir dinamismo visual al logo principal de la plataforma, mejorando la identidad visual del sitio.


## 💻 Requisitos e Instalación

### Requisitos previos
* PHP >= 8.4
* Composer
* Node.js & NPM
* Servidor MariaDB


## 🛠️ Instalación
1. Clonar el repositorio:
   ```bash
   git clone https://github.com/aguilarJonathan92/Proyecto-bengochea-aguilar.git
   cd Proyecto-bengochea-aguilar
   ```

2. Configurar variables de entorno en `.env` (Copias el `.env.example` y agregas tus datos).

### Datos Básicos para el .env
- **DB_CONNECTION**=mariadb
- **DB_HOST**=127.0.0.1
- **DB_PORT**=3306
- **DB_DATABASE**=db_bengochea_aguilar
- **DB_USERNAME**=NOMBRE_DE_TU_MOTOR
- **DB_PASSWORD**=CONTRASEÑA_DE_TU_MOTOR
- **APP_URL**=http://localhost:8000 
- **APP_LOCALE**=es
- **APP_FALLBACK_LOCALE**=es
- **APP_FAKER_LOCALE**=es_AR

 > **Nota:** Es importante el puerto :8000 en APP_URL para el correcto reconocimiento de las imágenes en filament



3. Instalar Dependencias y generamos clave
    ```bash
    composer install
    npm install
    php artisan key:generate
    php artisan storage:link
    ```

4. Ejecutamos migración (activar xampp o lo que o el servidor web local que utilices)
```bash
    php artisan migrate:fresh --seed 
```

5. Iniciamos servidor
```bash
    php artisan serve
```