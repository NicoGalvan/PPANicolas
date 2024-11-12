# Proyecto Laravel con Vite y Vue 3

Este proyecto es una aplicación web desarrollada con **Laravel**, **Vite**, **Vue 3** y **MySQL**. A continuación los pasos para poner en marcha el proyecto en tu entorno local.

## Requisitos previos

Antes de comenzar, asegúrate de tener instalados los siguientes programas en tu máquina:

- [PHP 8.1 o superior](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) (y NPM o Yarn)
- [MySQL](https://www.mysql.com/)

## Pasos para iniciar el proyecto

### 1. Clonar el repositorio

Primero, clona este repositorio en tu máquina local:

```bash
git clone https://github.com/NicoGalvan/PPANicolas.git
cd PPANicolas
```

### 2 Instalar dependencias del backend (Laravel)
```bash
composer install
```

### 3. Configuración de la base de datos
Crea una base de datos en MySQL para el proyecto y configura las credenciales en el archivo .env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```
### 4. Ejecutar migraciones y sembrar la base de datos
Para crear las tablas necesarias en la base de datos y poblarla con datos de ejemplo, ejecuta los siguientes comandos:

```bash
php artisan migrate --seed
```

### 5. Instalar dependencias del frontend (Vue 3 y Vite)
```bash
npm install
```
### 6. Iniciar el servidor de desarrollo
```bash
php artisan serve
```
```bash
npm run dev
```