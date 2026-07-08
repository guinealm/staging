Fase 4D — Migrar los 20 casos a MySQL
Objetivo

Pasar de esto:

data/casos.json → 20 casos

a esto:

MySQL → 20 casos en tablas corr_*

pero manteniendo:

index.html → sigue usando casos.json
index-db.html → prueba MySQL
Decisión técnica recomendada

No metería los 20 casos manualmente en phpMyAdmin.

Haría un pequeño script de importación, porque evita errores de copia/pega y permite repetir la carga si hay que borrar y volver a empezar.

La idea:

casos.json
   ↓
script importador
   ↓
corr_casos
corr_partidos
corr_fases
corr_tribunales
corr_personas
corr_caso_persona
corr_fuentes
Opción más cómoda

Como ya estamos usando Hostinger/PHP/MySQL, usaría un importador PHP temporal:

/projects/corrupcion/api/importar-json.php

Pero con mucho cuidado:

NO dejarlo público permanentemente
NO ejecutarlo sin protección
NO subir credenciales
NO tocar casos.json

Incluso mejor:

/projects/corrupcion/lab-bbdd/importar-json.php

Y después de usarlo, se borra o se deja bloqueado.

Flujo prudente
Paso 1  (OK)
======

Crear una copia de seguridad SQL desde phpMyAdmin:

Exportar base u794456529_corrupcion_lab

Así si algo sale mal, se restaura.

Paso 2 (OK)
======

Crear una tabla de control opcional:

CREATE TABLE corr_import_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    origen VARCHAR(255),
    casos_importados INT,
    observaciones TEXT
);

No imprescindible, pero útil.

Paso 3 (OK)
======

Vaciar solo datos de laboratorio, no estructura.

Por ejemplo:

DELETE FROM corr_fuentes;
DELETE FROM corr_caso_persona;
DELETE FROM corr_personas;
DELETE FROM corr_casos;

No borraría catálogos todavía:

corr_partidos
corr_fases
corr_tribunales

O también se pueden regenerar.

Paso 4
======

Importar los 20 casos desde data/casos.json.

Reglas del importador:

partido       → corr_partidos
fase          → corr_fases
tribunal      → corr_tribunales
caso          → corr_casos
personas      → dividir por comas y meter en corr_personas
fuente        → corr_fuentes
ultimaRevision → corr_casos.ultima_revision
Paso 5

Aplicar visibilidad pública.

Regla inicial:

visible_publico = 1 si estado = 'Activo'
visible_publico = 0 si estado = 'Excluido'

Pero revisable manualmente.

Problema importante: personas

El campo personas viene como texto:

José Luis Ábalos, Koldo García, Víctor de Aldama y otros

El importador lo puede dividir por comas. Eso sirve para laboratorio.

Pero hay casos delicados:

"CDC, PDeCAT, exgerentes y empresarios"
"Leire Díez, Vicente Fernández, Antxon Alonso; según informaciones recientes..."
"otros investigados"

Por eso no conviene considerar todavía personas como modelo definitivo. Para Fase 4D basta con una importación razonable.

La Fase 7 ya limpiará esto con fichas y diseño funcional.

Resultado esperado

Después de importar:

SELECT COUNT(*) FROM corr_casos;

Debe dar:

20

Y:

SELECT COUNT(*) FROM corr_v_casos_publicos;

Debe dar los visibles, probablemente menos de 20 si hay excluidos.

Luego:

index.html     → 20 casos desde JSON
index-db.html  → 20 o menos casos desde MySQL, según visible_publico