## 2. Inventario base de casos públicos

Extracción realizada desde MySQL sobre `corr_casos`, `corr_partidos` y `corr_fases`.

Fecha de extracción: 2026-07-09  
Total de casos públicos: 20  
Última revisión registrada en MySQL: 2026-05-27

127.0.0.1:3306/u794456529_corrupcion_lab/corr_casos/		https://auth-db1468.hstgr.io/index.php?route=/table/sql&db=u794456529_corrupcion_lab&table=corr_casos

   Mostrando filas 0 - 19 (total de 20, La consulta tardó 0.0006 segundos.) [id: 8... - 27...]


SELECT
    c.id,
    c.nombre AS titulo,
    COALESCE(p.nombre, 'Sin partido') AS partido,
    COALESCE(p.sigla, '') AS partido_sigla,
    COALESCE(f.nombre, 'Sin fase') AS fase,
    c.gravedad,
    c.vinculo,
    c.estado,
    c.visible_publico,
    c.observaciones AS resumen,
    c.ultima_revision
FROM corr_casos c
LEFT JOIN corr_partidos p
    ON c.partido_id = p.id
LEFT JOIN corr_fases f
    ON c.fase_id = f.id
WHERE c.visible_publico = 1
ORDER BY c.id ASC;


id   	titulo	partido	partido_sigla	fase	gravedad	vinculo	estado	visible_publico	resumen	ultima_revision	
8	Caso Koldo / mascarillas / Ábalos	PSOE / entorno PSOE	PSOE	Juicio visto para sentencia en pieza del Supremo; ...	Alta	Exministro y exasesor vinculados al PSOE; contrata...	Activo	1	El juicio en el Supremo por la pieza de mascarilla...	2026-05-27	
9	Caso Leire Díez / SEPI / Ferraz	PSOE / entorno PSOE	PSOE	Instrucción	Alta	Exmilitante y excargos socialistas; posible conexi...	Activo	1	El 27 de mayo de 2026 se informó de requerimientos...	2026-05-27	
10	Caso Begoña Gómez	PSOE / entorno PSOE	PSOE	Fase intermedia previa a posible apertura de juici...	Media	Entorno familiar del presidente del Gobierno; no c...	Activo	1	El juez Peinado citó a Begoña Gómez el 9 de junio ...	2026-05-27	
11	Caso David Sánchez / Diputación de Badajoz	PSOE / entorno PSOE	PSOE	Juicio oral señalado / inicio previsto 28 de mayo ...	Alta	Entorno familiar (hermano) del presidente; dirigen...	Activo	1	La Audiencia de Badajoz fijó el juicio para finale...	2026-05-27	
12	Caso Mediador	PSOE / entorno PSOE	PSOE	Instrucción finalizada / procedimiento abreviado; ...	Alta	Exdiputado socialista y trama político-empresarial	Activo	1	La magistrada finalizó la instrucción de la pieza ...	2026-05-27	
13	Caso Plus Ultra / Zapatero	PSOE / entorno PSOE	PSOE	Instrucción	Alta	Expresidente socialista; no causa contra el PSOE c...	Activo	1	El juez aplazó la declaración de Zapatero como inv...	2026-05-27	
14	Caso Azud	PSOE / PP valenciano		Instrucción / macrocausa viva	Alta	Supuesta financiación o pagos electorales a formac...	Activo	1	La UCO cifró pagos de constructoras al PSPV-PSOE y...	2026-05-27	
15	Caso ERE	PSOE / Andalucía		Fase residual: ejecución, efectos de sentencias de...	Alta	Excargos socialistas; administración autonómica so...	Activo	1	No está en instrucción ni juicio ordinario, pero m...	2026-05-27	
16	Operación Kitchen	PP / entorno PP	PP	Juicio oral en curso	Alta	Exministro y altos cargos del Gobierno del PP; pre...	Activo	1	El juicio se celebraba en mayo de 2026 en la Audie...	2026-05-27	
17	Púnica — Waiter Music	PP / Madrid		Juicio oral en curso	Alta	Excargos del PP madrileño; contratación municipal	Activo	1	Pieza sobre presunto amaño de contratos de fiestas...	2026-05-27	
18	Púnica — pieza 8 / Arpegio-Mintra	PP / Madrid		Apertura de juicio oral	Alta	Excargos del PP madrileño; obra pública y transpor...	Activo	1	La Audiencia Nacional abrió juicio oral contra Gra...	2026-05-27	
19	Lezo — campo de golf Canal Isabel II	PP / Madrid		Juicio oral señalado para septiembre de 2027	Alta	Expresidente madrileño del PP; empresa pública aut...	Activo	1	La Audiencia Nacional señaló para septiembre de 20...	2026-05-27	
20	Gürtel — última pieza fiscal / residual	PP	PP	Pendiente de sentencia o recursos según pieza	Alta	Trama vinculada históricamente al PP	Activo	1	La parte principal ya está sentenciada, pero a com...	2026-05-27	
21	Taula / Imelsa — pieza E	PP / Comunidad Valenciana		Juicio oral	Alta	Excargos y redes vinculadas al PP valenciano	Activo	1	En enero de 2026 comenzó un nuevo juicio de la pie...	2026-05-27	
22	Brugal — basuras de Orihuela	PP / Orihuela		Sentencia reciente; posible fase de recursos	Alta	Exalcaldesa y exconcejales del PP	Activo	1	La Audiencia de Alicante condenó en enero de 2026 ...	2026-05-27	
23	Caso Montoro / Equipo Económico	PP / entorno Rajoy		Instrucción	Alta	Exministro del PP; despacho vinculado a excargos	Activo	1	El juez mantiene la causa en Tarragona e investiga...	2026-05-27	
24	Alberto González Amador	PP / entorno Ayuso		Procesamiento confirmado / pendiente de juicio	Media	Entorno personal de Isabel Díaz Ayuso; no causa co...	Activo	1	La Audiencia de Madrid confirmó el procesamiento p...	2026-05-27	
25	La Vida Islados / Vicent Marí	PP / Ibiza		Apertura de juicio oral	Media	Presidente del Consell de Ibiza, PP	Activo	1	Abierto juicio oral por presunta prevaricación, tr...	2026-05-27	
26	Caso 3%	CDC / PDeCAT / Junts		Juicio oral abierto / pendiente de juicio	Alta	Presunta financiación ilegal de partido	Activo	1	Es el caso más claramente comparable a Gürtel por ...	2026-05-27	
27	Caso Pujol	CDC / entorno Pujol		Visto para sentencia	Alta	Entorno histórico de CDC; expresidente catalán	Activo	1	El juicio quedó visto para sentencia el 14 de mayo...	2026-05-27	

## 3. Revision editorial de julio 2026 - Bloque 1 (casos 8 a 12)

Fecha de corte para novedades: posterior a 2026-05-27.

### Caso 8 - Caso Koldo / mascarillas / Abalos
- Caso: 8
- Estado base (MySQL, 2026-05-27): Juicio visto para sentencia en pieza del Supremo
- Novedades confirmadas posteriores al corte:
    - 2026-06-22: el Tribunal Supremo dicta sentencia firme.
    - Condenas publicadas: Jose Luis Abalos (24 anos y 3 meses), Koldo Garcia (19 anos y 8 meses), Victor de Aldama (4 anos y medio, con suspension de ejecucion bajo condiciones).
    - Delitos recogidos en sentencia: organizacion criminal, cohecho, malversacion y trafico de influencias.
- Hipotesis, interpretaciones o ruido politico:
    - Narrativas partidistas sobre motivacion politica del proceso sin soporte en el fallo.
    - Lecturas mediaticas que extrapolan consecuencias no recogidas expresamente en la sentencia.
- Propuesta editorial Fase 6A:
    - Actualizarse (prioridad alta).
    - Cambiar de fase editorial: de juicio/sentencia pendiente a condena firme.
    - No ocultar.
    - No dejar pendiente para 6B: hay base suficiente para validacion editorial inmediata.
- Fuentes fiables:
    - RTVE, 2026-06-22: https://www.rtve.es/noticias/20260622/sentencia-supremo-caso-mascarillas-abalos-koldo/17108722.shtml
    - EFE, 2026-06-22: https://efe.com/espana/2026-06-22/abalos-condenado-carcel-koldo-mascarillas/

### Caso 9 - Caso Leire Diez / SEPI / Ferraz
- Caso: 9
- Estado base (MySQL, 2026-05-27): Instruccion
- Novedades confirmadas posteriores al corte:
    - 2026-06-29: el juez Pedraz amplia la causa e imputa a 25 personas, incluida la presidenta de la SEPI.
    - La ampliacion se produce en el marco de diligencias por posibles irregularidades en operativas vinculadas a entes publicos.
- Hipotesis, interpretaciones o ruido politico:
    - Afirmaciones de culpabilidad cerrada antes de juicio.
    - Mezcla de indicios policiales con hechos judicialmente probados.
- Propuesta editorial Fase 6A:
    - Actualizarse.
    - Mantener en fase de instruccion avanzada (sin salto a fase de condena).
    - No ocultar.
    - Dejar con seguimiento reforzado para validar nuevas resoluciones.
- Fuentes fiables:
    - elDiario.es, 2026-06-29: https://www.eldiario.es/politica/juez-caso-leire-imputa-presidenta-sepi-24-personas-supuestos-amanos-contratacion-publica_1_13342324.html
    - Cadena SER, 2026-06-29: https://cadenaser.com/nacional/2026/06/29/el-juez-pedraz-cita-como-investigada-a-la-presidenta-de-la-sepi-en-el-caso-leire-diez-cadena-ser/

### Caso 10 - Caso Begona Gomez
- Caso: 10
- Estado base (MySQL, 2026-05-27): Fase intermedia previa a posible apertura de juicio
- Novedades confirmadas posteriores al corte:
    - 2026-06-20/21: apertura de juicio oral y mantenimiento de medidas cautelares (retirada de pasaporte, prohibicion de salida de Espana, comparecencias).
    - 2026-07-09: la Fiscalia pide absolucion en su escrito de conclusiones para Begona Gomez y otros investigados.
- Hipotesis, interpretaciones o ruido politico:
    - Titulares que presentan condena segura o exoneracion total antes de sentencia.
    - Lecturas politicas que no distinguen fase procesal y fallo definitivo.
- Propuesta editorial Fase 6A:
    - Actualizarse.
    - Mantener en fase judicial activa con resultado abierto.
    - No ocultar.
    - Dejar en seguimiento estrecho hasta resolucion judicial de fondo.
- Fuentes fiables:
    - laSexta, 2026-06-21: https://www.lasexta.com/noticias/nacional/causa-begona-gomez-manos-audiencia-madrid-que-puede-recurrir-que-antes-juicio_202606216a37d6cb8774b34d61e5e7ce.html
    - El Confidencial, 2026-07-09: https://www.elconfidencial.com/espana/2026-07-09/fiscalia-pide-absolucion-begona-gomez-conclusiones_4387034/

### Caso 11 - Caso David Sanchez / Diputacion de Badajoz
- Caso: 11
- Estado base (MySQL, 2026-05-27): Juicio oral senalado / inicio previsto 28 de mayo de 2026
- Novedades confirmadas posteriores al corte:
    - 2026-06-01: la Audiencia de Badajoz declara prescrito el delito de nombramiento ilegal.
    - El juicio continua por prevaricacion y trafico de influencias.
    - 2026-06-08: en informes finales, las acusaciones mantienen tesis de irregularidad y la Fiscalia sostiene peticion de absolucion.
- Hipotesis, interpretaciones o ruido politico:
    - Formulaciones de culpabilidad o inocencia definitiva sin sentencia.
    - Sobrerreaccion politica sobre el parentesco sin valor probatorio autonomo.
- Propuesta editorial Fase 6A:
    - Actualizarse.
    - Mantener en fase de juicio visto para sentencia / pendiente de fallo.
    - No ocultar.
    - Dejar pendiente de cierre para Fase 6B hasta conocer sentencia.
- Fuentes fiables:
    - RTVE, 2026-06-01: https://www.rtve.es/noticias/20260601/juicio-david-sanchez-audiencia-badajoz-contratacion/17094164.shtml
    - RTVE, 2026-06-08: https://www.rtve.es/noticias/20260608/juicio-david-sanchez-informes-finales/17104918.shtml

### Caso 12 - Caso Mediador
- Caso: 12
- Estado base (MySQL, 2026-05-27): Instruccion finalizada / procedimiento abreviado
- Novedades confirmadas posteriores al corte:
    - 2026-06-24: se publica peticion fiscal de penas para acusados en el marco del caso (rama Tito Berni/Mediador).
    - No se identifica en este corte una sentencia firme nueva de la pieza principal posterior al 2026-05-27.
- Hipotesis, interpretaciones o ruido politico:
    - Confusion entre piezas procesales diferentes como si fueran una sola fase cerrada.
    - Afirmaciones de cierre definitivo sin resolucion final de todas las ramas.
- Propuesta editorial Fase 6A:
    - Actualizarse con cautela.
    - Mantener en fase judicial activa por piezas.
    - No ocultar.
    - Dejar pendiente de validacion de detalle por pieza para el pase a Fase 6B.
- Fuentes fiables:
    - Canarias7, 2026-06-24: https://www.canarias7.es/politica/coronel-viceconsejero-duenos-leche-sandra-penas-pide-20260624210412-nt.html
    - Canarias7 (seguimiento tematico, actualizado en julio 2026): https://www.canarias7.es/temas/generales/caso-mediador.html

## 4. Resumen editorial del bloque
- Casos revisados en este bloque: 5
- Con actualizacion recomendada: 5 (8, 9, 10, 11, 12)
- Cambio de fase recomendado: 1 (caso 8)
- Casos a ocultar: 0
- Casos en seguimiento pendiente para cierre de decision tecnica futura: 3 (9, 11, 12)

Nota metodologica:
Estas fichas son de validacion editorial Fase 6A. No implican cambios tecnicos, SQL ni alteraciones de codigo o base de datos.

## 5. Revision editorial de julio 2026 - Bloque 2 (casos 13 a 17)

Fecha de corte para novedades: posterior a 2026-05-27.

### Caso 13 - Caso Plus Ultra / Zapatero
- Caso: 13
- Estado base (MySQL, 2026-05-27): Instruccion
- Novedades confirmadas posteriores al corte:
    - 2026-06-12: el juez abre pieza separada para investigar presuntos delitos fiscal y de contrabando relacionados con joyas intervenidas, tasadas de forma preliminar en 1.323.915 euros.
    - 2026-06-23: la defensa de Zapatero presenta nuevo recurso cuestionando la validez y cadena de custodia de parte de la prueba digital incorporada al sumario.
- Hipotesis, interpretaciones o ruido politico:
    - Titulares que equiparan investigacion con condena cerrada.
    - Lecturas politicas que mezclan posicion partidista con estado procesal real.
- Propuesta editorial Fase 6A:
    - Actualizarse (prioridad alta).
    - Mantener en instruccion, con complejidad creciente por apertura de pieza separada.
    - No ocultar.
    - Dejar en seguimiento reforzado para validar proximas resoluciones judiciales de fondo.
- Fuentes fiables:
    - RTVE, 2026-06-12: https://www.rtve.es/noticias/20260612/juez-caso-plus-ultra-abre-pieza-separada-investigar-zapatero-delitos-fiscal-contrabando/17112593.shtml
    - RTVE, 2026-06-23: https://www.rtve.es/noticias/20260623/zapatero-vuelve-recurrir-decision-juez-sobre-contenido-movil-expresidente-plus-ultra/17127645.shtml

### Caso 14 - Caso Azud
- Caso: 14
- Estado base (MySQL, 2026-05-27): Instruccion / macrocausa viva
- Novedades confirmadas posteriores al corte:
    - 2026-06-08: la Audiencia Provincial de Valencia confirma la condicion de investigado de Jorge Bellver y desestima su recurso.
    - 2026-06-09: el PPCV abre expediente informativo interno tras la confirmacion judicial de su investigacion.
- Hipotesis, interpretaciones o ruido politico:
    - Uso partidista de la noticia interna de partido como si fuera resolucion judicial de culpabilidad.
    - Confusion entre hechos indiciarios del sumario y hechos probados en sentencia.
- Propuesta editorial Fase 6A:
    - Actualizarse.
    - Mantener en instruccion (sin cambio de fase a juicio o condena).
    - No ocultar.
    - Dejar en seguimiento por posible impacto de nuevas resoluciones en piezas concretas.
- Fuentes fiables:
    - Cadena SER, 2026-06-08: https://cadenaser.com/comunitat-valenciana/2026/06/08/la-audiencia-de-valencia-confirma-la-situacion-de-investigado-del-exedil-jorge-bellver-en-el-caso-azud-radio-valencia/
    - Europa Press, 2026-06-08: https://www.europapress.es/comunitat-valenciana/noticia-audiencia-confirma-imputacion-jorge-bellver-caso-azud-20260608125719.html

### Caso 15 - Caso ERE
- Caso: 15
- Estado base (MySQL, 2026-05-27): Fase residual (ejecucion y efectos de sentencias)
- Novedades confirmadas posteriores al corte:
    - En las fuentes revisadas para este bloque no se identifica, con estandar de confirmacion suficiente, un hito judicial nuevo posterior al 2026-05-27 que altere de forma sustantiva el estado del caso.
- Hipotesis, interpretaciones o ruido politico:
    - Reapertura ciclica de debate politico sin novedad procesal equivalente.
    - Confusion entre pronunciamientos anteriores y supuestas novedades de junio-julio no acreditadas.
- Propuesta editorial Fase 6A:
    - Mantener sin cambios de fase por el momento.
    - No ocultar.
    - Dejar explicitamente en observacion para proxima pasada 6A/6B por si aparece resolucion nueva verificable.
- Fuentes fiables:
    - RTVE, seguimiento de contexto juridico (ultimo hito relevante localizado en este corte): https://www.rtve.es/noticias/20260420/comision-europea-propone-tjue-se-declare-incompetente-caso-ere-andalucia/17033022.shtml

### Caso 16 - Operacion Kitchen
- Caso: 16
- Estado base (MySQL, 2026-05-27): Juicio oral en curso
- Novedades confirmadas posteriores al corte:
    - 2026-06-30: en conclusiones finales, la Fiscalia Anticorrupcion sostiene que se ha acreditado la participacion del exministro Fernandez Diaz en el operativo y mantiene su peticion de 15 anos de prision para varios acusados clave.
    - Se ratifica fase de cierre de juicio con alegatos finales, sin sentencia firme en este corte.
- Hipotesis, interpretaciones o ruido politico:
    - Titulares que presentan como condena definitiva lo que aun son conclusiones de parte acusadora.
    - Narrativas de exoneracion total antes de resolucion judicial final.
- Propuesta editorial Fase 6A:
    - Actualizarse.
    - Mantener en juicio oral avanzado / pendiente de sentencia.
    - No ocultar.
    - Dejar pendiente para cierre de decision tecnica cuando exista fallo.
- Fuentes fiables:
    - RTVE, 2026-06-30: https://www.rtve.es/noticias/20260630/juicio-kitchen-encara-su-recta-final-con-conclusiones-partes/17136950.shtml
    - EFE, 2026-06-30: https://efe.com/espana/2026-06-30/juicio-kitchen-fiscal-fernandez-diaz/

### Caso 17 - Punica - Waiter Music
- Caso: 17
- Estado base (MySQL, 2026-05-27): Juicio oral en curso
- Novedades confirmadas posteriores al corte:
    - 2026-07-02: la Audiencia Nacional condena a Francisco Granados a dos anos y medio de prision por delito continuado de fraude, e impone ademas inhabilitacion por prevaricacion en la pieza de contratos de festejos vinculada a Waiter Music.
    - La sentencia incluye condenas y absoluciones de otros acusados y delimita hechos probados de esta pieza concreta.
- Hipotesis, interpretaciones o ruido politico:
    - Extrapolar esta sentencia parcial al cierre total de toda la macrocausa Punica.
    - Lecturas partidistas que ignoran el alcance exacto de la pieza juzgada.
- Propuesta editorial Fase 6A:
    - Actualizarse (prioridad alta).
    - Cambiar de fase editorial a sentencia condenatoria en esta pieza.
    - No ocultar.
    - No dejar para 6B en la parte esencial de esta pieza: hay hito judicial claro y verificable.
- Fuentes fiables:
    - RTVE, 2026-07-02: https://www.rtve.es/noticias/20260702/audiencia-nacional-condena-francisco-granados-dos-anos-medio-carcel-juicio-punica/17141327.shtml
    - RTVE (antecedente del mismo tramo procesal), 2026-05-20: https://www.rtve.es/noticias/20260520/audiencia-nacional-juicio-caso-punica-granados-pp/17077309.shtml

## 6. Resumen editorial del bloque
- Casos revisados en este bloque: 5
- Con actualizacion recomendada: 4 (13, 14, 16, 17)
- Sin novedad suficientemente solida para cambio en este corte: 1 (15)
- Cambio de fase recomendado: 1 (caso 17)
- Casos a ocultar: 0
- Casos en seguimiento pendiente para cierre de decision tecnica futura: 4 (13, 14, 15, 16)

Nota metodologica:
Estas fichas son de validacion editorial Fase 6A. No implican cambios tecnicos, SQL ni alteraciones de codigo o base de datos.

## 7. Revision editorial de julio 2026 - Bloque 3 (casos 18 a 22)

Fecha de corte para novedades: posterior a 2026-05-27.

### Caso 18 - Punica - pieza 8 / Arpegio-Mintra
- Caso: 18
- Estado base (MySQL, 2026-05-27): Apertura de juicio oral
- Novedades confirmadas posteriores al corte:
    - No se identifica en este corte un hito judicial nuevo, posterior al 2026-05-27, con confirmacion suficiente en fuentes de referencia que cambie el estado base.
    - El envio a juicio de esta pieza se consolida en cobertura de finales de mayo de 2026, pero ese movimiento queda fuera del umbral temporal de este bloque.
- Hipotesis, interpretaciones o ruido politico:
    - Presentar como novedad de junio-julio un hito procesal que realmente corresponde a finales de mayo.
    - Generalizar el estado de toda la macrocausa Punica a partir de piezas distintas.
- Propuesta editorial Fase 6A:
    - Mantener sin cambios de fase en este corte.
    - No ocultar.
    - Dejar en seguimiento para la siguiente pasada por si aparecen nuevos autos o senalamientos.
- Fuentes fiables:
    - RTVE, 2026-05-26 (referencia de contexto inmediatamente previa al corte): https://www.rtve.es/noticias/20260526/an-lleva-a-juicio-a-francisco-granados-otras-40-personas-por-corrupcion-nueva-pieza-punica/17087011.shtml

### Caso 19 - Lezo - campo de golf Canal Isabel II
- Caso: 19
- Estado base (MySQL, 2026-05-27): Juicio oral senalado para septiembre de 2027
- Novedades confirmadas posteriores al corte:
    - No se localiza en este corte una novedad procesal posterior al 2026-05-27 que modifique de forma sustantiva el estado.
    - Se mantiene como referencia valida el senalamiento para septiembre de 2027 difundido a finales de 2025 y recogido en seguimientos de 2026.
- Hipotesis, interpretaciones o ruido politico:
    - Relecturas politicas del caso sin resolucion judicial nueva en junio-julio.
    - Confundir recordatorios periodisticos con hitos procesales nuevos.
- Propuesta editorial Fase 6A:
    - Mantener sin cambios de fase.
    - No ocultar.
    - Dejar en observacion hasta acercarse la ventana del juicio oral.
- Fuentes fiables:
    - Europa Press, 2025-12-23 (contexto vigente en el corte): https://www.europapress.es/nacional/noticia-an-fija-septiembre-2027-juicio-ignacio-gonzalez-adjudicaciones-asociadas-campo-golf-canal-20251223132052.html

### Caso 20 - Gurtel - ultima pieza fiscal / residual
- Caso: 20
- Estado base (MySQL, 2026-05-27): Pendiente de sentencia o recursos segun pieza
- Novedades confirmadas posteriores al corte:
    - En las fuentes revisadas para este bloque no se identifica, con estandar de confirmacion suficiente, un hito judicial nuevo posterior al 2026-05-27 que obligue a cambiar estado.
    - La referencia de Arganda localizada en RTVE corresponde al tramo marzo 2025 y no constituye novedad del periodo de corte actual.
- Hipotesis, interpretaciones o ruido politico:
    - Extrapolar movimientos de piezas concretas a un cierre global de todo Gurtel residual.
    - Reintroducir debates politicos antiguos como si fueran novedad judicial de junio-julio 2026.
- Propuesta editorial Fase 6A:
    - Mantener sin cambios de fase en este corte.
    - No ocultar.
    - Dejar en seguimiento por posible aparicion de sentencias o recursos en piezas pendientes.
- Fuentes fiables:
    - RTVE, 2025-03-31 (contexto de Arganda, previo al corte): https://www.rtve.es/noticias/20250331/todos-acusados-menos-uno-aceptan-penas-inferiores-tras-confesar-red-trama-guertel-arganda/16514444.shtml

### Caso 21 - Taula / Imelsa - pieza E
- Caso: 21
- Estado base (MySQL, 2026-05-27): Juicio oral
- Novedades confirmadas posteriores al corte:
    - 2026-06-23: la Audiencia Provincial de Valencia absuelve a los cinco acusados de la pieza E por falta de prueba suficiente y por prescripcion en parte de los hechos enjuiciados.
    - El fallo es relevante para el estado editorial de esta pieza, al pasar de fase de juicio a sentencia absolutoria en primera instancia.
- Hipotesis, interpretaciones o ruido politico:
    - Presentar la absolucion como cierre total de todo Taula/Imelsa cuando se trata de una pieza concreta.
    - Lecturas de culpabilidad social no alineadas con el fallo de esta causa.
- Propuesta editorial Fase 6A:
    - Actualizarse (prioridad alta).
    - Cambiar de fase editorial en esta pieza a sentencia absolutoria.
    - No ocultar.
    - Dejar en seguimiento por eventual recurso, pero con actualizacion inmediata del estado actual.
- Fuentes fiables:
    - Poder Judicial (TSJCV), 2026-06-23: https://www.poderjudicial.es/cgpj/eu/Botere-Judiziala/Berriak/Absueltos-los-cinco-acusados-de-la-pieza-E-del--caso-Taula--por-supuestas-irregularidades-en-contratos-de-la-Concejalia-de-Cultura-del-Ayuntamiento-de-Valencia
    - Cadena SER, 2026-06-23: https://cadenaser.com/comunitat-valenciana/2026/06/23/absueltos-los-cinco-acusados-de-la-pieza-e-del-caso-taula-por-falta-de-pruebas-y-prescripcion-de-delitos-radio-valencia/

### Caso 22 - Brugal - basuras de Orihuela
- Caso: 22
- Estado base (MySQL, 2026-05-27): Sentencia reciente; posible fase de recursos
- Novedades confirmadas posteriores al corte:
    - No se identifica en este corte un nuevo hito judicial firme posterior al 2026-05-27 que altere el estado base.
    - La condena relevante de esta pieza permanece en enero de 2026, por tanto anterior al umbral temporal aplicado en este bloque.
- Hipotesis, interpretaciones o ruido politico:
    - Tratar movimientos politico-administrativos locales como si fueran resoluciones judiciales de fondo.
    - Interpretar la existencia de posibles recursos como novedad sin resolucion nueva acreditada en este corte.
- Propuesta editorial Fase 6A:
    - Mantener sin cambios de fase en este corte.
    - No ocultar.
    - Dejar en observacion para detectar recursos o resoluciones posteriores verificables.
- Fuentes fiables:
    - Europa Press, 2026-01-12 (hito principal de contexto, previo al corte): https://www.europapress.es/comunitat-valenciana/noticia-condenada-exalcaldesa-orihuela-tres-exediles-causa-basuras-pieza-matriz-brugal-20260112145719.html
    - EFE, 2026-01-12 (contraste de la misma resolucion): https://efe.com/comunidad-valenciana/2026-01-12/condenada-la-exalcaldesa-de-orihuela-por-el-contrato-de-basuras/

## 8. Resumen editorial del bloque
- Casos revisados en este bloque: 5
- Con actualizacion recomendada: 1 (21)
- Sin novedad suficientemente solida para cambio en este corte: 4 (18, 19, 20, 22)
- Cambio de fase recomendado: 1 (caso 21)
- Casos a ocultar: 0
- Casos en seguimiento pendiente para cierre de decision tecnica futura: 4 (18, 19, 20, 22)

Nota metodologica:
Estas fichas son de validacion editorial Fase 6A. No implican cambios tecnicos, SQL ni alteraciones de codigo o base de datos.

## 9. Revision editorial de julio 2026 - Bloque 4 (casos 23 a 27)

Fecha de corte para novedades: posterior a 2026-05-27.

### Caso 23 - Caso Montoro / Equipo Economico
- Caso: 23
- Estado base (MySQL, 2026-05-27): Instruccion
- Novedades confirmadas posteriores al corte:
    - En este corte no se identifica un hito judicial nuevo, posterior al 2026-05-27, con confirmacion suficiente que obligue a cambio de fase en la ficha base.
    - El material localizado se concentra en contexto explicativo del caso y en hitos anteriores al corte actual.
- Hipotesis, interpretaciones o ruido politico:
    - Convertir piezas de contexto mediatico en novedades procesales.
    - Presentar como avance judicial cerrado lo que sigue siendo fase de instruccion.
- Propuesta editorial Fase 6A:
    - Mantener sin cambios de fase en este corte.
    - No ocultar.
    - Dejar en seguimiento de resoluciones del juzgado instructor y de la Audiencia provincial competente.
- Fuentes fiables:
    - RTVE, 2025-07-17 (contexto general de la causa): https://www.rtve.es/noticias/20250717/claves-del-caso-montoro-asi-operaba-presunta-trama-salpica-a-altos-cargos-gobiernos-aznar-rajoy/16667734.shtml

### Caso 24 - Alberto Gonzalez Amador
- Caso: 24
- Estado base (MySQL, 2026-05-27): Procesamiento confirmado / pendiente de juicio
- Novedades confirmadas posteriores al corte:
    - 2026-06-02: es citado como testigo en una causa distinta (filtracion de datos de periodistas), vinculada a su entorno procesal pero no equivalente al nucleo del procedimiento fiscal de su ficha base.
    - No se confirma en este corte un hito de fondo posterior al 2026-05-27 que modifique su estado base principal.
- Hipotesis, interpretaciones o ruido politico:
    - Mezclar procedimientos distintos como si constituyeran un unico avance de la causa principal.
    - Proyectar consecuencias penales de un expediente a otro sin resolucion judicial de fondo.
- Propuesta editorial Fase 6A:
    - Actualizacion menor de contexto (opcional), sin cambio de fase.
    - No ocultar.
    - Mantener seguimiento en la causa principal para detectar senalamiento o resoluciones posteriores.
- Fuentes fiables:
    - EL PAIS, 2026-06-02: https://elpais.com/espana/2026-06-02/gonzalez-amador-citado-a-declarar-como-testigo-el-30-de-junio-por-la-filtracion-de-datos-de-periodistas-de-el-pais.html

### Caso 25 - La Vida Islados / Vicent Mari
- Caso: 25
- Estado base (MySQL, 2026-05-27): Apertura de juicio oral
- Novedades confirmadas posteriores al corte:
    - 2026-06-11: el Juzgado de Instruccion n. 4 de Ibiza remite la causa a la Audiencia Provincial de Palma para su enjuiciamiento.
    - Queda explicitamente pendiente de senalamiento de vista oral por el organo de enjuiciamiento.
- Hipotesis, interpretaciones o ruido politico:
    - Presentar la remision a Audiencia como sentencia o como cierre definitivo del caso.
    - Lecturas partidistas que sustituyen el estado procesal real por valoraciones politicas.
- Propuesta editorial Fase 6A:
    - Actualizarse.
    - Mantener fase de juicio oral, refinando el estado a: remitido a Audiencia y pendiente de fecha.
    - No ocultar.
    - Dejar seguimiento operativo hasta senalamiento y eventual celebracion.
- Fuentes fiables:
    - Diario de Ibiza, 2026-06-11: https://www.diariodeibiza.es/ibiza/2026/06/11/caso-vida-islados-presidente-consell-131293231.html

### Caso 26 - Caso 3%
- Caso: 26
- Estado base (MySQL, 2026-05-27): Juicio oral abierto / pendiente de juicio
- Novedades confirmadas posteriores al corte:
    - En las fuentes revisadas para este bloque no se identifica, con estandar de confirmacion suficiente, un hito judicial nuevo posterior al 2026-05-27 que exija cambiar fase.
    - Se mantiene el estado de causa pendiente de juicio oral en piezas de financiacion ilegal, sin novedad robusta validada en este corte.
- Hipotesis, interpretaciones o ruido politico:
    - Tratar piezas de seguimiento periodistico o enlaces agregados como autos firmes nuevos.
    - Reabrir debates politicos historicos como si fueran novedad procesal del periodo.
- Propuesta editorial Fase 6A:
    - Mantener sin cambios de fase en este corte.
    - No ocultar.
    - Dejar en observacion para capturar autos de senalamiento o inicio efectivo de juicio.
- Fuentes fiables:
    - Cadena SER (tag tematico de seguimiento): https://cadenaser.com/tag/caso_tres_por_ciento/a/

### Caso 27 - Caso Pujol
- Caso: 27
- Estado base (MySQL, 2026-05-27): Visto para sentencia
- Novedades confirmadas posteriores al corte:
    - No se confirma en este corte una sentencia posterior al 2026-05-27.
    - El ultimo hito fuerte localizado sigue siendo que el juicio quedo visto para sentencia el 2026-05-14, es decir, anterior al umbral temporal de este bloque.
- Hipotesis, interpretaciones o ruido politico:
    - Dar por existente una sentencia firme que no ha sido publicada de forma verificable en este corte.
    - Confundir expectativas de calendario con resolucion judicial efectiva.
- Propuesta editorial Fase 6A:
    - Mantener sin cambios de fase en este corte.
    - No ocultar.
    - Mantener seguimiento activo hasta publicacion del fallo.
- Fuentes fiables:
    - RTVE, 2026-05-14 (hito de contexto previo al corte): https://www.rtve.es/noticias/20260514/juicio-pujol-visto-sentencia/17069650.shtml

## 10. Resumen editorial del bloque
- Casos revisados en este bloque: 5
- Con actualizacion recomendada: 1 (25)
- Con actualizacion menor de contexto, sin cambio de fase: 1 (24)
- Sin novedad suficientemente solida para cambio en este corte: 3 (23, 26, 27)
- Cambio de fase recomendado: 0
- Casos a ocultar: 0
- Casos en seguimiento pendiente para cierre de decision tecnica futura: 5 (23, 24, 25, 26, 27)

Nota metodologica:
Estas fichas son de validacion editorial Fase 6A. No implican cambios tecnicos, SQL ni alteraciones de codigo o base de datos.
