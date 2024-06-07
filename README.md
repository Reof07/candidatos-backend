# Prueba Candidatos API REST con Laravel

## Descripción

Este proyecto es una API RESTful construida con Laravel que gestiona candidatos. Implementa autenticación JWT, manejo de roles de usuario (manager y agent), y varias operaciones CRUD.

## Características

-   **Autenticación JWT**: Genera tokens de acceso para usuarios autenticados.
-   **Roles de usuario**: Soporte para roles de manager y agent.
-   **CRUD de candidatos**: Crear, obtener un candidato por ID, obtener todos los candidatos.
-   **Pruebas unitarias**: Cobertura de las funcionalidades principales con PHPUnit.

## Requisitos

-   PHP 8.0+
-   Composer
-   MySQL
-   Redis
-   Node.js (para herramientas de frontend, si es necesario)

## Instalación

### Paso 1: Clonar el Repositorio

```bash
https://github.com/Reof07/candidatos-backend.git
cd candidatos-backend.git
```

### Paso 2: Paso 2: Instalar Dependencias

```bash
composer install
```

### Paso 3: Configurar el Entorno

1. Copia el archivo .env.example y renómbralo a .env:

```bash
cp .env.example .env
```

2. Edita el archivo .env y configura las variables de entorno:

-   Configuración de base de datos
-   Configuración de Redis

### Paso 4: Generar la Clave de la Aplicación

```bash
php artisan jwt:secret
```

### Paso 5: Migrar y correr seeders

```bash
php artisan migrate --seed
```

### Paso 6: Ejecutar el servidor

```bash
php artisan optimize
php artisan serve
```

## Uso

### Autenticación

1.Generar token de acceso

```https
POST /auth
{
  "username": "tester",
  "password": "PASSWORD"
}
```

### Endpoints

-   Crear Candidato: POST /lead
-   Obtener Candidato por ID: GET /lead/{id}
-   Obtener todos los Candidatos: GET /leads

## Pruebas

### Ejecutar Pruebas Unitarias

```bash
php artisan test
```

## Create by RAMON OJEDA.
