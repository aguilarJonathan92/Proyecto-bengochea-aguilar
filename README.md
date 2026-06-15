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


## 📂 Estructura del proyecto

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

---

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