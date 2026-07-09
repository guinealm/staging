# Fase 6A - Actualizacion de datos e investigacion

## 1) Objetivo de la fase
Establecer un marco editorial y metodologico para revisar, actualizar y priorizar informacion de los casos del proyecto de corrupcion sin ejecutar cambios tecnicos todavia.

Esta fase prepara:
- investigacion guiada por evidencia
- validacion humana antes de cualquier actualizacion tecnica
- trazabilidad de decisiones editoriales

Resultado esperado de Fase 6A:
- lista validada de cambios editoriales propuestos por caso
- lista de cambios aprobados para ejecutar en Fase 6B
- lista de dudas y pendientes para investigacion adicional

## 2) Criterio principal
MySQL es fuente tecnica, no origen intelectual.

Interpretacion operativa:
- La base MySQL guarda y estructura informacion.
- El origen intelectual de cada cambio debe venir de investigacion verificable (fuentes, documentos, hechos comprobables).
- Ningun dato se considera valido solo por existir en base de datos.

## 3) Reparto de funciones (ChatGPT, usuario, Codex)
### ChatGPT (investigacion y redaccion preliminar)
- Investigar novedades por caso en fuentes publicas y confiables.
- Proponer actualizaciones editoriales con justificacion.
- Identificar posibles contradicciones, vacios y dudas.
- Entregar propuestas en formato de plantilla.

### Usuario (criterio editorial y validacion final)
- Definir alcance, prioridad y enfoque narrativo.
- Validar o rechazar propuestas de actualizacion.
- Resolver casos dudosos con criterio editorial.
- Autorizar que un cambio pase a fase tecnica.

### Codex (soporte tecnico controlado)
- Preparar documentos, estructura y trazabilidad.
- Aplicar solo cambios tecnicos autorizados por el usuario.
- Mantener consistencia de formato y estados.
- No ejecutar cambios de datos sin aprobacion explicita.

## 4) Tipos de actualizacion
- Actualizacion factual: cambia un hecho verificable (fecha, estado judicial, monto, actores).
- Actualizacion contextual: agrega contexto que mejora comprension sin alterar el hecho central.
- Correccion editorial: corrige redaccion, claridad, etiquetas o estructura.
- Reclasificacion: cambia categoria o prioridad de un caso por nueva evidencia.
- Alta potencial: incorpora un nuevo candidato para evaluacion.
- Baja tecnica (solo propuesta en 6A): sugerir exclusion futura por baja relevancia o falta de evidencia.

## 5) Criterios de inclusion
Un cambio puede proponerse si cumple uno o mas puntos:
- Existe fuente publica verificable y trazable.
- Tiene impacto en comprension publica del caso.
- Afecta el estado procesal, institucional o economico.
- Mejora precision o reduce ambiguedad relevante.
- Es consistente con el enfoque editorial del proyecto.

## 6) Criterios de exclusion
No se incluye en propuesta de cambio cuando:
- No hay fuente verificable o la fuente es debil.
- Es rumor, opinion no sustentada o contenido especulativo.
- Duplica informacion ya incorporada sin valor agregado.
- Introduce sesgo no justificado o lenguaje valorativo impropio.
- Requiere confirmacion que no puede completarse en el ciclo actual.

## 7) Estados editoriales
Estados recomendados para el seguimiento de cada caso y cada propuesta:
- Sin cambios
- Cambio detectado
- En revision
- Duda metodologica
- Aprobado para Fase 6B
- Rechazado
- Pendiente de evidencia

Regla de gobernanza:
- Solo el estado "Aprobado para Fase 6B" habilita ejecucion tecnica posterior.

## 8) Plantilla de revision por caso
Usar esta plantilla para cada uno de los casos activos:

### Ficha de revision de caso
- ID del caso:
- Nombre corto:
- Estado editorial actual:
- Fecha de revision:
- Fuentes revisadas:
- Resumen de hallazgos:
- Cambios detectados (si/no):
- Tipo de cambio:
- Riesgos o dudas:
- Recomendacion:
- Decision del usuario:
- Estado final de esta revision:

## 9) Plantilla de propuesta de actualizacion
Cuando haya cambios detectados, completar esta propuesta:

### Propuesta de actualizacion
- Caso:
- Version/fecha de propuesta:
- Proponente:
- Hecho nuevo o correccion:
- Evidencia principal (fuente y fecha):
- Evidencia secundaria (opcional):
- Impacto esperado en el caso:
- Texto sugerido (resumen editorial):
- Cambios estructurales sugeridos (si aplica):
- Riesgos de interpretacion:
- Recomendacion final:
- Decision del usuario: aprobar / rechazar / pedir mas evidencia
- Estado para pipeline: aprobado F6B / pendiente / descartado

## 10) Flujo mensual, trimestral y anual
### Flujo mensual
- Recoleccion de novedades por caso.
- Revision inicial y clasificacion en estados editoriales.
- Consolidacion de propuestas y dudas.
- Validacion del usuario de cambios prioritarios.

### Flujo trimestral
- Auditoria de coherencia entre casos y categorias.
- Repriorizacion de casos segun impacto y evidencia.
- Cierre de pendientes acumulados.
- Definicion de lote de cambios candidatos a Fase 6B.

### Flujo anual
- Revision integral del marco metodologico.
- Ajuste de criterios de inclusion/exclusion.
- Evaluacion de calidad editorial del ano.
- Planificacion de mejoras para el siguiente ciclo.

## 11) Limites operativos de Fase 6A
Esta fase NO ejecuta:
- cambios en MySQL
- cambios en PHP
- cambios en scripts
- cambios en JSON
- cambios en paginas publicas
- cambios en estilos CSS

Fase 6A solo produce marco editorial, revision documentada y decisiones preparatorias para Fase 6B.
