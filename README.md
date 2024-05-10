# ByDN Instagram

**Versión:** 1.0.0  
**Autor:** [Daniel Navarro](https://danielnavarroymas.com)  
**Licencia:** GPLv2 o posterior  
**Text Domain:** bydn-instagram  

## Descripción

**ByDN Instagram** es un plugin de WordPress orientado a desarrolladores que permite la integración básica de publicaciones de Instagram en una web, de forma que se puede usar como base para adaptarlo a las necesidades de cada proyecto.

La configuración únicamente necesita tu ID de instagram y el token de acceso. 

Una tarea cron recuperará a la base de datos de wordpress los post de instagram (caption y url) y mediante un shortcode proporcionado se pueden insertar las imágenes filtradas por #hashtag en las páginas o post que se desee.

La maquetación proporcionada es básica y se espera que el desarrollador la adapte al proyecto.

### Características

- **Configuración Sencilla:** Una página de configuración en el panel de administración para agregar tu cuenta de Instagram y token.
- **Sincronización Automática:** Una tarea programada que sincroniza las publicaciones automáticamente cada hora.
- **Shortcode Personalizable:** Un shortcode `[instagram_posts]` que puede usarse para mostrar publicaciones filtradas.
- **Diseño Modular:** El código está dividido en módulos para facilitar la extensión y personalización.

### Requisitos

- WordPress 5.0+
- PHP 5.7+

## Instalación

### Manual

1. Descarga el archivo `.zip` del plugin.
2. Extrae el contenido y sube la carpeta `bydn-instagram` al directorio `wp-content/plugins/`.
3. Activa el plugin desde el panel de administración de WordPress.

## Uso

### Configuración

1. Ve a "ByDN Instagram" en el menú de administración.
2. Ingresa tu **Instagram Account** y **Instagram Token**.
3. Haz clic en "Guardar Cambios".

### Shortcode

- **Mostrar Todas las Publicaciones:**
  ```html
  [instagram_posts]

- **Mostrar publicaciones que tengan el hashtag #verano:**
  ```html
  [instagram_posts caption="verano"]
