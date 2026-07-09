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
