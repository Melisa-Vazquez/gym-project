# Sistema de Gestión de Gimnasio - Laravel

Sistema completo de gestión para gimnasios desarrollado con Laravel 11, Jetstream, Livewire 3, y un sistema de roles con Spatie Permission.

## Tabla de Contenidos

- [Características](#características)
- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Tecnologías Utilizadas](#tecnologías-utilizadas)
- [Comandos Útiles](#comandos-útiles)
- [Licencia](#licencia)

## Características

- Sistema de autenticación con Laravel Jetstream
- Gestión de roles y permisos con Spatie Permission
- Interfaz moderna con Tailwind CSS, WireUI y Flowbite
- Componentes Livewire para interactividad en tiempo real
- Gestión de usuarios con foto de perfil
- Panel de administración completo
- Sistema de notificaciones
- Diseño responsive y moderno

## Requisitos

- PHP >= 8.2
- Composer
- MySQL >= 8.0
- Node.js >= 18.x
- NPM >= 9.x

## Instalación

### 1. Crear el Proyecto

\`\`\`bash
composer create-project laravel/laravel gym_db_project
cd gym_db_project
\`\`\`

### 2. Instalar Dependencias PHP

\`\`\`bash
# Paquete de idioma español
composer require --dev laravel-lang/lang

# Sistema de permisos
composer require spatie/laravel-permission

# WireUI para componentes Livewire
composer require wireui/wireui
\`\`\`

### 3. Instalar Dependencias JavaScript

\`\`\`bash
npm install
npm install flowbite
\`\`\`

### 4. Configurar Base de Datos

Crear la base de datos en MySQL:

\`\`\`sql
CREATE DATABASE gym_db_project
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
\`\`\`

Crear el usuario (si es necesario):

\`\`\`sql
CREATE USER 'root'@'localhost' IDENTIFIED BY '123';
GRANT ALL PRIVILEGES ON gym_db_project.* TO 'root'@'localhost';
FLUSH PRIVILEGES;
\`\`\`

### 5. Configurar Variables de Entorno

Editar el archivo `.env`:

\`\`\`env
APP_NAME="Sistema Gimnasio"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost

# Configuración regional
APP_LOCALE=es
APP_FALLBACK_LOCALE=es
APP_FAKER_LOCALE=es_MX
APP_TIMEZONE=America/Merida

# Base de datos
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gym_db_project
DB_USERNAME=root
DB_PASSWORD=123

# Foto de perfil
APP_ENV=public
\`\`\`

### 6. Ejecutar Migraciones y Seeders

\`\`\`bash
# Ejecutar migraciones
php artisan migrate

# Publicar configuraciones
php artisan vendor:publish --tag='wireui.config'
php artisan vendor:publish --tag='wireui.resources'
php artisan vendor:publish --tag='wireui.lang'

# Agregar idioma español
php artisan lang:add es

# Ejecutar seeders
php artisan db:seed
\`\`\`

### 7. Compilar Assets

\`\`\`bash
# Desarrollo
npm run dev

# Producción
npm run build
\`\`\`

### 8. Iniciar Servidor

\`\`\`bash
php artisan serve
\`\`\`

El sistema estará disponible en `http://localhost:8000`

## Configuración

### Configuración Regional

**Archivo: `config/app.php`**

\`\`\`php
'locale' => env('APP_LOCALE', 'es'),
'fallback_locale' => env('APP_FALLBACK_LOCALE', 'es'),
'faker_locale' => env('APP_FAKER_LOCALE', 'es_MX'),
'timezone' => 'America/Merida',
\`\`\`

### Configuración de Jetstream

**Habilitar foto de perfil:**

Descomentar la línea 63 en el archivo de configuración de Jetstream para habilitar la gestión de foto de perfil.

### Configuración de Tailwind CSS

**Archivo: `tailwind.config.js`**

\`\`\`javascript
import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

export default {
    presets: [
        require('./vendor/wireui/wireui/tailwind.config.js')
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php',
        './node_modules/flowbite/**/*.js'
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#eff6ff',
                    100: '#dbeafe',
                    200: '#bfdbfe',
                    300: '#93c5fd',
                    400: '#60a5fa',
                    500: '#3b82f6',
                    600: '#2563eb',
                    700: '#1d4ed8',
                    800: '#1e40af',
                    900: '#1e3a8a',
                    950: '#172554',
                }
            }
        },
    },
    plugins: [forms, typography, require('flowbite/plugin')],
};
\`\`\`

### Configuración de WireUI

**Archivo: `config/wireui.php`**

\`\`\`php
return [
    'icons' => [
        'style' => 'outline',
    ],
    'style' => [
        'shadow' => 'shadow-md',
        'rounded' => 'rounded-lg',
        'color' => 'primary',
    ],
];
\`\`\`

## Estructura del Proyecto

\`\`\`
gym_db_project/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Admin/
│   │   │       ├── RoleController.php
│   │   │       └── UserController.php
│   │   └── Livewire/
│   │       └── Admin/
│   │           ├── RoleIndex.php
│   │           └── UserIndex.php
│   ├── Models/
│   │   ├── User.php
│   │   └── Role.php
│   └── Providers/
├── database/
│   ├── migrations/
│   └── seeders/
│       ├── DatabaseSeeder.php
│       ├── RoleSeeder.php
│       └── UserSeeder.php
├── resources/
│   ├── css/
│   │   └── app.css
│   ├── js/
│   │   └── app.js
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── livewire/
│       │   ├── navigation-menu.blade.php
│       │   └── admin/
│       └── dashboard.blade.php
├── routes/
│   ├── web.php
│   └── admin.php
└── public/
\`\`\`

## Tecnologías Utilizadas

### Backend
- **Laravel 11** - Framework PHP
- **Jetstream** - Scaffolding de autenticación
- **Livewire 3** - Componentes dinámicos full-stack
- **Spatie Permission** - Sistema de roles y permisos
- **MySQL 8** - Base de datos

### Frontend
- **Tailwind CSS 3** - Framework CSS utility-first
- **WireUI** - Componentes Livewire estilizados
- **Flowbite** - Componentes UI con Tailwind
- **Alpine.js** - JavaScript reactivo (incluido con Livewire)

## Comandos Útiles

### Desarrollo

\`\`\`bash
# Iniciar servidor de desarrollo
php artisan serve

# Compilar assets en modo desarrollo
npm run dev

# Limpiar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Ver rutas
php artisan route:list
\`\`\`

### Base de Datos

\`\`\`bash
# Ejecutar migraciones
php artisan migrate

# Revertir última migración
php artisan migrate:rollback

# Refrescar base de datos
php artisan migrate:fresh

# Refrescar y ejecutar seeders
php artisan migrate:fresh --seed

# Ejecutar un seeder específico
php artisan db:seed --class=RoleSeeder
\`\`\`

### Livewire

\`\`\`bash
# Crear componente Livewire
php artisan make:livewire NombreComponente

# Listar componentes Livewire
php artisan livewire:list
\`\`\`

### Producción

\`\`\`bash
# Optimizar aplicación
php artisan optimize

# Compilar assets para producción
npm run build

# Cachear configuración
php artisan config:cache

# Cachear rutas
php artisan route:cache

# Cachear vistas
php artisan view:cache
\`\`\`

## Seeders del Sistema

### DatabaseSeeder

Ejecuta todos los seeders en orden:

\`\`\`php
public function run(): void
{
    $this->call([
        RoleSeeder::class,
        UserSeeder::class,
    ]);
}
\`\`\`

### RoleSeeder

Crea los roles básicos del sistema:
- Admin
- Usuario
- Entrenador
- Recepcionista

### UserSeeder

Crea usuarios de prueba con roles asignados.

## Sistema de Roles

El sistema utiliza **Spatie Permission** para gestionar roles y permisos:

\`\`\`php
// Asignar rol a usuario
$user->assignRole('admin');

// Verificar rol en Blade
@role('admin')
    <!-- Contenido solo para admin -->
@endrole

// Verificar permiso
@can('edit posts')
    <!-- Contenido si tiene permiso -->
@endcan

// Middleware en rutas
Route::middleware(['role:admin'])->group(function () {
    // Rutas protegidas
});
\`\`\`

## Estilos CSS Personalizados

El archivo `resources/css/app.css` incluye clases utilitarias personalizadas:

\`\`\`css
/* Botones */
.btn-primary
.btn-secondary
.btn-success
.btn-danger

/* Cards */
.card

/* Tablas */
.table-custom
\`\`\`

## Componentes WireUI

### Botones

```blade
<x-button primary label="Guardar" wire:click="save" />
<x-button secondary label="Cancelar" />
<x-button negative label="Eliminar" />
