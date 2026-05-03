# Servi-Ferre web

Web PHP estatica/dinamica sencilla para Servi-Ferre.

## Estructura

```text
.
|-- index.php                  # Entradas publicas que mantienen las URLs actuales
|-- servicios.php
|-- tecnologias.php
|-- empleados.php
|-- contacto.php
|-- procesar_contacto.php
|-- css/                       # Estilos publicos
|-- js/                        # Scripts publicos
|-- img/                       # Imagenes publicas
|-- src/
|   |-- pages/                 # Contenido de paginas
|   |-- layout/                # Header y footer
|   |-- helpers/               # Utilidades compartidas
|   |-- actions/               # Procesadores de formularios
|   `-- auth/                  # Entradas auxiliares de autenticacion
|-- config/                    # Configuracion privada
|-- storage/                   # Ficheros generados por la aplicacion
`-- database/                  # SQL y material de base de datos
```

Las rutas publicas se mantienen igual: `/`, `/servicios.php`, `/contacto.php`,
`/css/estilos.css`, `/js/animaciones.js` e `/img/...`.

## Desarrollo local

```powershell
php -S localhost:8000
```

Abre `http://localhost:8000` en el navegador.
