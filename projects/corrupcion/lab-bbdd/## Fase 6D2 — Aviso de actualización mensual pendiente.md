## Fase 6D.2 — Aviso de actualización mensual pendiente

Trabajar sobre la aplicación:

`staging.jumalenin.com/projects/corrupcion/`

### Objetivo

Mostrar junto a la fecha de última revisión general un aviso automático cuando haya transcurrido el plazo mensual de actualización.

### Requisitos

1. Localizar en la página principal la leyenda actual:

   `Fecha de corte inicial: 27/05/2026`

2. Sustituirla por:

   `Última revisión aplicada: DD/MM/AAAA`

3. La fecha debe obtenerse dinámicamente de los datos procedentes de MySQL a través del endpoint existente `casos.php`.

4. Para calcular la última revisión general, utilizar el valor máximo del campo `ultima_revision` de todos los casos.

5. Si han transcurrido más de 35 días desde esa fecha, mostrar a su lado un aviso visible:

   `Pendiente de actualización mensual`

6. Si no han transcurrido más de 35 días, no mostrar ningún aviso.

7. Aspecto visual:

   * La fecha y el aviso deben aparecer en la misma zona.
   * El aviso debe distinguirse visualmente, pero sin resultar alarmista.
   * Debe adaptarse correctamente a móvil.
   * No modificar el diseño general de la tabla ni de los filtros.

8. No crear botones de actualización.

9. No modificar MySQL, la estructura de las tablas ni los datos.

10. No añadir todavía tablas de control de actualizaciones.

11. Mantener el funcionamiento actual de:

* carga de casos desde MySQL;
* filtros;
* ordenación;
* visualización en escritorio;
* visualización móvil.

### Lógica orientativa

* Consultar `casos.php`.
* Recorrer los casos y obtener la fecha máxima de `ultima_revision`.
* Compararla con la fecha actual.
* Mostrar el aviso cuando la diferencia sea superior a 35 días.

### Resultado esperado

Con una última revisión aplicada de `10/07/2026`, la página debe mostrar inicialmente:

`Última revisión aplicada: 10/07/2026`

Cuando hayan pasado más de 35 días sin modificar las fechas de revisión:

`Última revisión aplicada: 10/07/2026 · Pendiente de actualización mensual`

Al ejecutar posteriormente una SQL que actualice las fechas de revisión, el aviso debe desaparecer automáticamente.

Antes de realizar cambios, identificar los archivos concretos que será necesario modificar. Al finalizar, indicar:

* archivos modificados;
* lógica incorporada;
* pruebas realizadas;
* confirmación de que no se ha modificado MySQL ni la estructura de datos.
