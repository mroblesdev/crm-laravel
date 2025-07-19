<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## CRM Laravel

Gestión de Relaciones con Clientes, es un software que permite gestionar interacciones y relaciones con clientes y prospectos. Ayuda a centralizar la información de los clientes, automatizar procesos de ventas y marketing, lo que resulta en un mejor servicio al cliente y aumento de la eficiencia.

## Requerimientos

- PHP
- MySQL
- Composer


## Instalación

Sigue estos pasos para instalar y ejecutar el proyecto:

1. **Clona el repositorio**
   ```sh
   git clone https://github.com/mroblesdev/crm-laravel.git
   cd crm-laravel
   ```

2. **Instala las dependencias de PHP con Composer**
   ```sh
   composer install
   ```

3. **Copia el archivo de entorno y configura tus variables**
   ```sh
   cp .env.example .env
   ```
   Edita el archivo `.env` con tus credenciales de base de datos y configuración local.

4. **Genera la clave de la aplicación**
   ```sh
   php artisan key:generate
   ```

5. **Crea la base de datos y ejecuta las migraciones**
   ```sh
   php artisan migrate
   ```

6. **(Opcional) Ejecuta los seeders para datos de ejemplo**
   ```sh
   php artisan db:seed
   ```

7. **Inicia el servidor de desarrollo**
   ```sh
   php artisan serve
   ```

8. **Accede a la aplicación**
    Abre tu navegador y visita [http://localhost:8000](http://localhost:8000)

   **Datos de acceso**

   - **Usuario:** admin@mail.com

   - **Contraseña:** admin123


## Expresiones de Gratitud 🎁

- Comenta a otros sobre este proyecto 📢
- Invitame una cerveza 🍺 o un café ☕ [Da clic aquí](https://www.paypal.com/paypalme/markorobles?locale.x=es_XC.).
