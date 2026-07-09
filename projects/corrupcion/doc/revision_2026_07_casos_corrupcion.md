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
