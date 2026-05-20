<p align="center"><img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel"></p>

<p align="center">
<img src="https://img.shields.io/badge/Blade-FF2D20?style=flat-square" alt="Blade 63.4%">
<img src="https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP 29.8%">
<img src="https://img.shields.io/badge/Vue.js-35495E?style=flat-square&logo=vue.js&logoColor=4FC08D" alt="Vue 5.8%">
<img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black" alt="JavaScript 0.4%">
<img src="https://img.shields.io/badge/CSS-1572B6?style=flat-square&logo=css3&logoColor=white" alt="CSS 0.4%">
<img src="https://img.shields.io/badge/Docker-2496ED?style=flat-square&logo=docker&logoColor=white" alt="Docker">
</p>

# 🏪 Tenderete - Proyecto Intermodular

Tenderete es una aplicación web moderna desarrollada como proyecto intermodular que integra **Laravel**, **Blade**, **Vue.js** y tecnologías de frontend para crear una plataforma robusta y escalable.

## 📋 Descripción del Proyecto

Este proyecto combina el poder del framework **Laravel** en el backend con plantillas dinámicas en **Blade** y componentes interactivos en **Vue.js** para ofrecer una experiencia de usuario excepcional.

## 🛠️ Tecnologías Utilizadas

### Backend
- **PHP** (29.8%) - Lenguaje backend principal
- **Laravel** - Framework web robusto y elegante
- **Blade** (63.4%) - Motor de plantillas de Laravel

### Frontend
- **Vue.js** (5.8%) - Framework JavaScript progresivo
- **JavaScript** (0.4%) - Lógica frontend
- **CSS** (0.4%) - Estilos personalizados

### DevOps & Containerización
- **Docker** (0.1%) - Containerización de la aplicación
- **Shell** (0.1%) - Scripts de automatización

## 🚀 Características Principales

- ✨ Interfaz moderna y responsiva
- 🔐 Sistema de autenticación robusto
- 📦 Arquitectura modular
- ⚡ Rendimiento optimizado
- 🐳 Fácil despliegue con Docker

## 📦 Requisitos Previos

- PHP 8.0 o superior
- Composer
- Node.js y npm
- Docker (opcional)
- MySQL/PostgreSQL

## 🔧 Instalación

### 1. Clonar el repositorio
```bash
git clone https://github.com/BeykelDaniel/Tenderete--Proyecto-Intermodular.git
cd Tenderete--Proyecto-Intermodular
```

### 2. Instalar dependencias de PHP
```bash
composer install
```

### 3. Instalar dependencias de frontend
```bash
npm install
```

### 4. Configurar el archivo .env
```bash
cp .env.example .env
php artisan key:generate
```

### 5. Configurar la base de datos
Edita el archivo `.env` con tus credenciales de base de datos y ejecuta:
```bash
php artisan migrate
```

### 6. Compilar assets
```bash
npm run dev
```

## 📝 Uso

### Desarrollo local
```bash
php artisan serve
npm run dev
```

### Build para producción
```bash
npm run build
```

### Con Docker
```bash
docker-compose up -d
```

## 📁 Estructura del Proyecto

```
├── app/                 # Código PHP de la aplicación
├── resources/
│   ├── views/          # Plantillas Blade (63.4%)
│   └── js/             # Componentes Vue.js (5.8%)
├── routes/             # Definición de rutas
├── database/           # Migraciones y seeders
├── public/             # Archivos públicos
├── docker-compose.yml  # Configuración Docker
└── package.json        # Dependencias frontend
```

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

## 👤 Autor

**BeykelDaniel** - [GitHub](https://github.com/BeykelDaniel)

## 📞 Contacto

Para más información o preguntas sobre el proyecto, no dudes en abrir un issue en el repositorio.

---

<p align="center">Hecho con ❤️ usando Laravel, Vue.js y amor por el código</p>
