# Laboratorio BBDD - Procedimientos Corrupción

## Objetivo

Prototipar una base de datos relacional MySQL para sustituir en el futuro el fichero `data/casos.json`, sin modificar todavía la web funcional.

## Estado actual

La web sigue funcionando con:

- `index.html`
- `assets/css/styles.css`
- `assets/js/app.js`
- `data/casos.json`

No se ha tocado producción.

## Base de datos

Base de datos MySQL en Hostinger/phpMyAdmin:

- `u794456529_corrupcion_lab`

## Tablas principales

- `corr_casos`
- `corr_partidos`
- `corr_fases`
- `corr_tribunales`
- `corr_personas`
- `corr_caso_persona`
- `corr_fuentes`

## Vistas

### `corr_v_casos_json`

Vista equivalente a la estructura de `casos.json`.

Incluye:

- partido
- caso
- fase
- tribunal
- personas
- gravedad
- vinculo
- estado
- observaciones
- fuente
- ultimaRevision

### `corr_v_casos_publicos`

Vista filtrada para casos visibles públicamente.

Criterio actual:

```sql
WHERE estado = 'Activo'