Estamos en el subproyecto:

/projects/corrupcion/

Objetivo:
Documentar la Fase 4 de laboratorio BBDD y conexión experimental MySQL, sin modificar la web funcional ni cambiar código de aplicación.

Condiciones estrictas:
- NO modificar index.html.
- NO modificar assets/js/app.js.
- NO modificar assets/css/styles.css.
- NO modificar data/casos.json.
- NO modificar api/casos.php.
- NO modificar index-db.html.
- NO modificar assets/js/app-db.js.
- NO incluir credenciales.
- Solo crear o actualizar documentación.

Tareas:
1. Crear la carpeta /projects/corrupcion/lab-bbdd/ si no existe.
2. Crear o actualizar /projects/corrupcion/lab-bbdd/README.md.
3. Documentar lo siguiente:

## Objetivo
Prototipar una base de datos relacional MySQL para el subproyecto Procedimientos Corrupción, sin sustituir todavía el JSON funcional.

## Estado de producción
La web funcional sigue usando:
- index.html
- assets/js/app.js
- assets/css/styles.css
- data/casos.json

Esta versión muestra los 20 casos originales.

## Laboratorio BBDD
Base de datos MySQL:
- u794456529_corrupcion_lab

Tablas:
- corr_casos
- corr_partidos
- corr_fases
- corr_tribunales
- corr_personas
- corr_caso_persona
- corr_fuentes

Campo añadido:
- visible_publico en corr_casos

## Vistas
- corr_v_casos_json_con_id
- corr_v_casos_json
- corr_v_casos_publicos

La vista pública usa visible_publico = 1.

## API
Endpoint experimental:
- api/casos.php

Lee desde:
- corr_v_casos_publicos

Carga credenciales desde:
- api/db_config.local.php

Importante:
- db_config.local.php no debe subirse a GitHub.
- db_config.example.php es solo una plantilla.

## App experimental
Versión de laboratorio:
- index-db.html
- assets/js/app-db.js

Esta versión lee desde:
- api/casos.php

## Pruebas realizadas
- index.html muestra 20 casos desde data/casos.json.
- api/casos.php devuelve JSON válido con 3 casos públicos desde MySQL.
- index-db.html muestra 3 casos desde MySQL.
- El caso Vox / préstamo húngaro está en BBDD pero no aparece en la vista pública porque visible_publico = 0.

## Decisión validada
La BBDD puede contener más información que la web pública.
La visibilidad pública se controla con visible_publico y no solo con estado.
La sustitución del JSON puede hacerse de forma gradual.

## Próximos pasos posibles
1. Cargar los 20 casos en BBDD.
2. Mantener index.html con JSON mientras index-db.html prueba MySQL.
3. Evaluar exportación automática de MySQL a JSON.
4. Más adelante decidir si producción pasa a API o sigue con JSON generado.