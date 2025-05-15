
Built by https://www.blackbox.ai

---

# HispanoArgo - Registro de Soldado

HispanoArgo es un sistema de registro para soldados diseñado para facilitar la gestión de datos, incluyendo información personal, contactos, y documentación útil para los militares. Este proyecto utiliza tecnologías modernas como Tailwind CSS, JavaScript y almacenamiento local para ofrecer una experiencia de usuario fluida y agradable.

## Tabla de Contenido
- [Descripción del Proyecto](#descripción-del-proyecto)
- [Instalación](#instalación)
- [Uso](#uso)
- [Características](#características)
- [Dependencias](#dependencias)
- [Estructura del Proyecto](#estructura-del-proyecto)

## Descripción del Proyecto

HispanoArgo permite a los usuarios gestionar la información de los soldados mediante un sistema de formularios interactivos. Los usuarios pueden registrar, editar, eliminar y ver la lista de soldados, así como gestionar perfiles de usuarios y sus permisos.

## Instalación

Para instalar y ejecutar el proyecto localmente, sigue estos pasos:

1. **Clonar el repositorio**:
   ```bash
   git clone https://github.com/tu-usuario/hispanoargo.git
   cd hispanoargo
   ```

2. **Instalar dependencias**:
   Si usas Composer o el administrador de paquetes de JavaScript, instala las dependencias necesarias.

3. **Configuración**:

   Asegúrate de tener un servidor local (como XAMPP o MAMP) corriendo y configura el archivo `functions.php` para ajustar las rutas de acceso y otros parámetros si es necesario.

4. **Ejecutar el proyecto**:
   Abre tu navegador y accede a la dirección local del sitio, usualmente algo como `http://localhost/hispanoargo`.

## Uso

Una vez que el sistema esté en ejecución, puedes acceder a las siguientes secciones:
- **Acceso al sistema**: Puedes iniciar sesión en el sistema utilizando las credenciales predeterminadas (admin/admin123) o crear nuevas cuentas.
- **Registro de Soldados**: Completar el formulario para registrar nuevos soldados. Asegúrate de llenar todos los campos obligatorios.
- **Panel de Administración**: Los administradores pueden gestionar usuarios y soldados, así como editar permisos y configuraciones del sistema.

## Características

- Interfaz de usuario intuitiva y responsiva.
- Soporte para múltiples idiomas (Español, Inglés, Ucraniano).
- Sistema robusto para registro de soldados con formularios validados.
- Panel de administración para gestión de usuarios y roles.
- Funciones para exportar datos a Excel y PDF.
- Autenticación de usuario con gestión de roles (administrador, editor, visualizador).

## Dependencias

El proyecto utiliza las siguientes dependencias:

- [Tailwind CSS](https://tailwindcss.com/): Para estilos CSS.
- [Font Awesome](https://fontawesome.com/): Para iconos.
- [Flag Icons](https://github.com/lipis/flag-icons): Para iconos de banderas.
  
Además, utiliza JavaScript para la funcionalidad del lado del cliente y almacenamiento local para guardar información temporalmente.

```json
{
  "dependencies": {
    "tailwindcss": "^2.2.19",
    "fontawesome": "^6.0.0-beta3",
    "flag-icons": "^6.6.6"
  }
}
```

## Estructura del Proyecto

La estructura del proyecto se presenta de la siguiente manera:

```
hispanoargo/
├── admin.html         # Página para administración de registros
├── dashboard.html     # Panel de control del usuario
├── index.html         # Página principal de registro
├── login.html         # Página de inicio de sesión
├── soldiers.html      # Listado de soldados
├── languages.js       # Archivo de gestión de idiomas
├── functions.php      # Funciones de WordPress para el tema
├── header.php         # Cabecera del tema
├── footer.php         # Pie de página del tema
├── style.css          # Estilos principales del tema
└── page-*             # Plantillas de páginas personalizadas
```

## Contribución

Las contribuciones son bienvenidas. Si tienes sugerencias o mejoras, por favor abre un *issue* o envía un *pull request*.
Estas entusiasma el soporte de la comunidad para mejorar el sistema HispanoArgo.

## Licencia

Este proyecto está bajo la Licencia Pública General GNU v2 o posterior. Consulta el archivo LICENSE para más detalles.