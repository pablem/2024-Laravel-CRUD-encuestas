## Nota 

en este repositorio se trata de integrar los componentes de frontend con el proyecto backend creado en Laravel

## Requisitos Previos

- PHP
- Composer
- Node.js
- Base de datos: PostgreSQL

## Configuración Inicial

1. **Clona el Repositorio:**

2. **Instala Dependencias de PHP:**
    ```bash
    composer install
    ```
3. **Instala Dependencias de Node.js:**
    ```bash
    npm install
    ```
4. **Configura el Archivo de Entorno:**
    - Copia `.env.example` a `.env` y escribe tu contraseña de postgres 
5. **Genera la Clave de la Aplicación:**
    ```bash
    php artisan key:generate
    ```
6. **Ejecuta las Migraciones:**
    ```bash
    php artisan migrate
    ```

## Ejecución del Proyecto

1. **Inicia los servidores de Desarrollo:**

    ```bash
    npm run dev
    ```
    ```bash
    php artisan serve
    ```
