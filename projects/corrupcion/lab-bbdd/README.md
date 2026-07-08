# Laboratorio BBDD - Corrupcion

## Fase 4E

Esta microfase agrega herramientas de control para comparar el estado tecnico entre JSON y MySQL sin sustituir produccion.

- `index.html` sigue siendo la version estable y lee `data/casos.json`.
- `index-db.html` sigue siendo la version experimental y lee datos desde MySQL via `api/casos.php`.
- `api/status.php` sirve como endpoint tecnico de control para verificar recuentos y fecha de referencia en MySQL.
- La sustitucion de `index.html` por MySQL todavia no se ha realizado.

### Endpoint de control

Ruta: `projects/corrupcion/api/status.php`

Salida esperada (JSON UTF-8):

- `origen`
- `total_casos_tabla`
- `total_casos_publicos`
- `ultima_revision_max`
- `fecha_servidor`
- `estado`

Si hay error de conexion o consulta, devuelve `estado: error` y mensaje de error en JSON.
