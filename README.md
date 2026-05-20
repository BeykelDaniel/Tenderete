<p align="center"><img src="public/logo.png" alt="Tenderete Logo" width="250" height="250"></p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/LARAVEL-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12.x">
  <img src="https://img.shields.io/badge/MYSQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL 8.0">
  <img src="https://img.shields.io/badge/JAVASCRIPT-ESM-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript ESM">
  <img src="https://img.shields.io/badge/VUE.JS-3-35495E?style=for-the-badge&logo=vue.js&logoColor=4FC08D" alt="Vue.js 3">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/TAILWIND_CSS-3-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS 3">
  <img src="https://img.shields.io/badge/VITE-7-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite 7">
  <img src="https://img.shields.io/badge/NODE.JS-18.x-339933?style=for-the-badge&logo=node.js&logoColor=white" alt="Node.js 18.x">
  <img src="https://img.shields.io/badge/COMPOSER-2.x-885630?style=for-the-badge&logo=composer&logoColor=white" alt="Composer 2.x">
  <img src="https://img.shields.io/badge/GIT-FF3333?style=for-the-badge&logo=git&logoColor=white" alt="Git">
</p>

# 🏪 Tenderete - Proyecto Intermodular

Tenderete es una aplicación web moderna desarrollada como proyecto intermodular que integra **Laravel**, **Blade**, **Vue.js** y tecnologías modernas para crear una plataforma robusta, escalable e interactiva.

## 📋 Descripción del Proyecto

Este proyecto combina el poder del framework **Laravel** en el backend con plantillas dinámicas en **Blade** y componentes interactivos en **Vue.js** para ofrecer una experiencia de usuario excepcional. Es una solución integral que demuestra integración profesional de múltiples tecnologías web.

## 🛠️ Stack Tecnológico

### Backend
- **PHP** 8.2+ - Lenguaje backend principal
- **Laravel** 12.x - Framework web robusto y elegante
- **Blade** - Motor de plantillas de Laravel
- **Composer** 2.x - Gestor de paquetes PHP

### Frontend
- **Vue.js** 3 - Framework JavaScript progresivo para UI interactiva
- **JavaScript** ESM - Lógica frontend moderna
- **Tailwind CSS** 3 - Framework de utilidades CSS
- **Vite** 7 - Build tool ultra rápido

### Base de Datos & DevOps
- **MySQL** 8.0 - Base de datos relacional
- **Node.js** 18.x - Runtime JavaScript
- **Git** - Control de versiones
- **Docker** - Containerización (opcional)

## ✨ Características Principales

- 🎨 Interfaz moderna y responsiva con Vue.js 3
- ⚡ Build ultra rápido con Vite 7
- 🎯 Estilos con Tailwind CSS 3
- 🔐 Sistema de autenticación robusto
- 📦 Arquitectura modular y escalable
- ⚙️ Rendimiento optimizado
- 🐳 Fácil despliegue con Docker
- 🔄 Componentes reutilizables
- 📱 Diseño mobile-first

## 📦 Requisitos Previos

- **PHP** >= 8.2
- **Composer** 2.x - Gestor de paquetes de PHP
- **Node.js** >= 18.x
- **npm** o **yarn**
- **MySQL** 8.0 o superior
- **Docker** (opcional pero recomendado)
- **Git** - Control de versiones

## 🚀 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/BeykelDaniel/Tenderete--Proyecto-Intermodular.git
cd Tenderete--Proyecto-Intermodular
```

### 2. Instalar dependencias PHP

```bash
composer install
```

### 3. Instalar dependencias de frontend

```bash
npm install
```

### 4. Configurar el archivo de entorno

```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configurar la base de datos

Edita el archivo `.env` con tus credenciales:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tenderete
DB_USERNAME=root
DB_PASSWORD=
```

Luego ejecuta las migraciones:

```bash
php artisan migrate
```

### 6. Compilar assets

Para desarrollo:
```bash
npm run dev
```

Para producción:
```bash
npm run build
```

## 💻 Uso

### Desarrollo Local

```bash
# Terminal 1: Iniciar servidor Laravel
php artisan serve

# Terminal 2: Compilar assets en tiempo real con Vite
npm run dev
```

La aplicación estará disponible en `http://localhost:8000`

### Build para Producción

```bash
npm run build
php artisan optimize
```

### Con Docker

```bash
docker-compose up -d
```

Accede a la aplicación en `http://localhost:80`

## 📁 Estructura del Proyecto

```
Tenderete--Proyecto-Intermodular/
├── app/                      # Código PHP y lógica de la aplicación
│   ├── Http/
│   │   ├── Controllers/      # Controladores Laravel
│   │   └── Requests/         # Form Requests
│   ├── Models/               # Modelos de base de datos
│   └── Services/             # Servicios de la aplicación
├── resources/
│   ├── views/                # Plantillas Blade (Laravel)
│   ├── js/                   # Componentes Vue.js 3
│   └── css/                  # Estilos Tailwind CSS
├── routes/
│   └── web.php               # Definición de rutas web
├── database/
│   ├── migrations/           # Migraciones de BD
│   └── seeders/              # Seeders de datos
├── public/
│   └── img/                  # Archivos públicos (logo.png aquí)
├── vite.config.js            # Configuración Vite
├── tailwind.config.js        # Configuración Tailwind CSS
├── docker-compose.yml        # Configuración Docker
├── package.json              # Dependencias Node.js
├── composer.json             # Dependencias PHP
└── README.md                 # Este archivo
```

## 🔧 Configuración

### Variables de Entorno

Archivo `.env` principales:

```env
APP_NAME=Tenderete
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tenderete
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
```

### Optimización para Producción

```bash
# Cachear configuración
php artisan config:cache

# Cachear rutas
php artisan route:cache

# Cachear vistas
php artisan view:cache

# Optimizar autoloader
composer install --optimize-autoloader --no-dev
```

## 🧪 Testing

```bash
php artisan test
```

Con reporte de cobertura:

```bash
php artisan test --coverage
```

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor sigue estos pasos:

1. **Fork** el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un **Pull Request**

## 📄 Licencia

Este proyecto está bajo la **Licencia MIT**. Ver el archivo `LICENSE` para más detalles.

## 👤 Autor

**BeykelDaniel**

- GitHub: [@BeykelDaniel](https://github.com/BeykelDaniel)
- Repositorio: [Tenderete--Proyecto-Intermodular](https://github.com/BeykelDaniel/Tenderete--Proyecto-Intermodular)

## 📞 Contacto y Soporte

Para preguntas, sugerencias o reportar problemas:

- Abre un [issue](https://github.com/BeykelDaniel/Tenderete--Proyecto-Intermodular/issues)
- Contacta directamente a través de GitHub

## 📚 Recursos Útiles

- [Documentación de Laravel](https://laravel.com/docs)
- [Documentación de Vue.js 3](https://vuejs.org/)
- [Documentación de Vite](https://vitejs.dev/)
- [Documentación de Tailwind CSS](https://tailwindcss.com/)
- [Documentación de Blade](https://laravel.com/docs/blade)

---

<p align="center">
  <strong>Hecho con ❤️ usando Laravel, Vue.js, Vite y mucho amor por el código</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/github/repo-size/BeykelDaniel/Tenderete--Proyecto-Intermodular?style=flat-square" alt="Repo Size">
  <img src="https://img.shields.io/github/last-commit/BeykelDaniel/Tenderete--Proyecto-Intermodular?style=flat-square" alt="Last Commit">
  <img src="https://img.shields.io/badge/license-MIT-blue?style=flat-square" alt="License">
</p>
