<?php
// --- CONFIGURACIÓN DE LA BASE DE DATOS ---
// Cambia estos valores por los de tu Hostinger
$servername = "<?php
// --- CONFIGURACIÓN DE LA BASE DE DATOS ---
// Cambia estos valores por los de tu Hostinger
$servername = "localhost";
$username   = "u123456789_guinealm";  // Tu usuario de BD
$password   = "45%eeWWW";  // Tu contraseña de BD
$dbname     = "u123456789_cuadro_mando";    // Tu nombre de BD

// Conexión
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$mensaje = "";
$tipo_alerta = "";

// --- PROCESAR EL FORMULARIO (CUANDO LE DAS A GUARDAR) ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Recoger datos biometría
    $fecha = $_POST['fecha'];
    $peso = !empty($_POST['peso_kg']) ? $_POST['peso_kg'] : 'NULL';
    $sis = !empty($_POST['tension_sistolica']) ? $_POST['tension_sistolica'] : 'NULL';
    $dia = !empty($_POST['tension_diastolica']) ? $_POST['tension_diastolica'] : 'NULL';
    $h_sueno = !empty($_POST['horas_sueno']) ? $_POST['horas_sueno'] : 'NULL';
    $hinchazon = $_POST['nivel_hinchazon_piernas'];
    
    // Checkboxes de hábitos (si no se marcan, valen 0)
    $sal = isset($_POST['dieta_baja_sal']) ? 1 : 0;
    $embutidos = isset($_POST['dieta_sin_embutidos']) ? 1 : 0;
    $fruta = isset($_POST['consumo_fruta']) ? 1 : 0;
    
    // Insertar en registro_diario
    $sql1 = "INSERT INTO registro_diario (fecha, peso_kg, tension_sistolica, tension_diastolica, horas_sueno, nivel_hinchazon_piernas, dieta_baja_sal, dieta_sin_embutidos, consumo_fruta) 
             VALUES ('$fecha', $peso, $sis, $dia, $h_sueno, '$hinchazon', '$sal', '$embutidos', '$fruta')";

    if ($conn->query($sql1) === TRUE) {
        $last_id = $conn->insert_id; // Necesitamos este ID para vincular las medicinas

        // 2. Recoger medicación (Checkboxes)
        $atenolol = isset($_POST['atenolol']) ? 1 : 0;
        $felodipino = isset($_POST['felodipino']) ? 1 : 0;
        $lamotrigina_d = isset($_POST['lamotrigina_d']) ? 1 : 0;
        $lamotrigina_c = isset($_POST['lamotrigina_c']) ? 1 : 0;
        $edoxaban = isset($_POST['edoxaban']) ? 1 : 0;
        $simvastatina = isset($_POST['simvastatina']) ? 1 : 0;
        $medias = isset($_POST['medias']) ? 1 : 0;

        $sql2 = "INSERT INTO control_medicacion (fecha, atenolol_100mg, felodipino_5mg, lamotrigina_100mg_desayuno, lamotrigina_100mg_cena, edoxaban_60mg, simvastatina_20mg, medias_compresion)
                 VALUES ('$fecha', '$atenolol', '$felodipino', '$lamotrigina_d', '$lamotrigina_c', '$edoxaban', '$simvastatina', '$medias')";
        
        if ($conn->query($sql2) === TRUE) {
            $mensaje = "✅ Datos guardados correctamente.";
            $tipo_alerta = "success";
        } else {
            $mensaje = "Error al guardar medicación: " . $conn->error;
            $tipo_alerta = "danger";
        }
    } else {
        // Error común: Clave duplicada (ya existe registro para hoy)
        if ($conn->errno == 1062) {
            $mensaje = "⚠️ Ya has registrado datos para esta fecha. Usa 'Editar' (próximamente).";
            $tipo_alerta = "warning";
        } else {
            $mensaje = "Error: " . $sql1 . "<br>" . $conn->error;
            $tipo_alerta = "danger";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Mi Salud Personal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f6f9; }
        .card { border-radius: 15px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .form-check-input { width: 1.6em; height: 1.6em; margin-right: 10px; }
        .form-check-label { padding-top: 5px; font-size: 1.1em; }
        .btn-guardar { width: 100%; padding: 15px; font-size: 1.2em; font-weight: bold; border-radius: 12px; }
        .seccion-titulo { color: #0d6efd; font-weight: bold; margin-bottom: 15px; display: flex; align-items: center; }
        .seccion-titulo i { margin-right: 10px; font-size: 1.4em; }
    </style>
</head>
<body>

<div class="container py-3">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Hola, Luis María</h2>
        <span class="badge bg-primary rounded-pill">Hoy: <?php echo date('d/m'); ?></span>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert alert-<?php echo $tipo_alerta; ?> alert-dismissible fade show" role="alert">
            <?php echo $mensaje; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        
        <div class="mb-3">
            <input type="date" class="form-control form-control-lg text-center fw-bold" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
        </div>

        <div class="card p-3">
            <h5 class="seccion-titulo"><i class="bi bi-heart-pulse"></i> Biometría</h5>
            <div class="row g-3">
                <div class="col-6">
                    <label class="form-label text-muted small">Peso (kg)</label>
                    <input type="number" step="0.1" class="form-control form-control-lg" name="peso_kg" placeholder="95.0">
                </div>
                <div class="col-6">
                    <label class="form-label text-muted small">Sueño (horas)</label>
                    <input type="number" step="0.5" class="form-control form-control-lg" name="horas_sueno" placeholder="6.0">
                </div>
                <div class="col-6">
                    <label class="form-label text-muted small">Tensión Alta</label>
                    <input type="number" class="form-control" name="tension_sistolica" placeholder="130">
                </div>
                <div class="col-6">
                    <label class="form-label text-muted small">Tensión Baja</label>
                    <input type="number" class="form-control" name="tension_diastolica" placeholder="80">
                </div>
                <div class="col-12 mt-3">
                    <label class="form-label text-muted small">Hinchazón Piernas (1=Nada, 5=Mucha)</label>
                    <div class="d-flex justify-content-between px-2">
                        <span>1</span>
                        <input type="range" class="form-range w-75" min="1" max="5" name="nivel_hinchazon_piernas" value="1">
                        <span>5</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-3">
            <h5 class="seccion-titulo"><i class="bi bi-capsule"></i> Medicación</h5>
            
            <div class="mb-3 bg-light p-2 rounded">
                <strong class="text-secondary small text-uppercase">Desayuno</strong>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="atenolol" id="atenolol" checked>
                    <label class="form-check-label" for="atenolol">Atenolol 100mg</label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="felodipino" id="felodipino" checked>
                    <label class="form-check-label" for="felodipino">Felodipino 5mg</label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="lamotrigina_d" id="lamotrigina_d" checked>
                    <label class="form-check-label" for="lamotrigina_d">Lamotrigina 100mg</label>
                </div>
            </div>

            <div class="mb-3 bg-light p-2 rounded">
                <strong class="text-secondary small text-uppercase">Cena / Noche</strong>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="lamotrigina_c" id="lamotrigina_c" checked>
                    <label class="form-check-label" for="lamotrigina_c">Lamotrigina 100mg</label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="edoxaban" id="edoxaban" checked>
                    <label class="form-check-label" for="edoxaban">Edoxaban 60mg (Lixiana)</label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="simvastatina" id="simvastatina" checked>
                    <label class="form-check-label" for="simvastatina">Simvastatina 20mg</label>
                </div>
            </div>
            
            <div class="mb-3 bg-light p-2 rounded">
                <strong class="text-secondary small text-uppercase">Otros</strong>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="medias" id="medias" checked>
                    <label class="form-check-label" for="medias">Medias Compresión</label>
                </div>
            </div>
        </div>

        <div class="card p-3">
            <h5 class="seccion-titulo"><i class="bi bi-apple"></i> Hábitos Hoy</h5>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="dieta_baja_sal" id="sal">
                <label class="form-check-label" for="sal">Comí bajo en Sal</label>
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="dieta_sin_embutidos" id="embutidos">
                <label class="form-check-label" for="embutidos">Evité Embutidos/Queso</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="consumo_fruta" id="fruta">
                <label class="form-check-label" for="fruta">Comí Fruta/Ensalada</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-guardar shadow">
            <i class="bi bi-check-circle-fill"></i> GUARDAR DATOS
        </button>

    </form>
    
    <div class="text-center mt-4 text-muted small">
        <p>App Salud Personal v1.0</p>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>";
$username   = "u123456789_usuario";  // Tu usuario de BD
$password   = "TuContraseñaSegura";  // Tu contraseña de BD
$dbname     = "u123456789_salud";    // Tu nombre de BD

// Conexión
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$mensaje = "";
$tipo_alerta = "";

// --- PROCESAR EL FORMULARIO (CUANDO LE DAS A GUARDAR) ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Recoger datos biometría
    $fecha = $_POST['fecha'];
    $peso = !empty($_POST['peso_kg']) ? $_POST['peso_kg'] : 'NULL';
    $sis = !empty($_POST['tension_sistolica']) ? $_POST['tension_sistolica'] : 'NULL';
    $dia = !empty($_POST['tension_diastolica']) ? $_POST['tension_diastolica'] : 'NULL';
    $h_sueno = !empty($_POST['horas_sueno']) ? $_POST['horas_sueno'] : 'NULL';
    $hinchazon = $_POST['nivel_hinchazon_piernas'];
    
    // Checkboxes de hábitos (si no se marcan, valen 0)
    $sal = isset($_POST['dieta_baja_sal']) ? 1 : 0;
    $embutidos = isset($_POST['dieta_sin_embutidos']) ? 1 : 0;
    $fruta = isset($_POST['consumo_fruta']) ? 1 : 0;
    
    // Insertar en registro_diario
    $sql1 = "INSERT INTO registro_diario (fecha, peso_kg, tension_sistolica, tension_diastolica, horas_sueno, nivel_hinchazon_piernas, dieta_baja_sal, dieta_sin_embutidos, consumo_fruta) 
             VALUES ('$fecha', $peso, $sis, $dia, $h_sueno, '$hinchazon', '$sal', '$embutidos', '$fruta')";

    if ($conn->query($sql1) === TRUE) {
        $last_id = $conn->insert_id; // Necesitamos este ID para vincular las medicinas

        // 2. Recoger medicación (Checkboxes)
        $atenolol = isset($_POST['atenolol']) ? 1 : 0;
        $felodipino = isset($_POST['felodipino']) ? 1 : 0;
        $lamotrigina_d = isset($_POST['lamotrigina_d']) ? 1 : 0;
        $lamotrigina_c = isset($_POST['lamotrigina_c']) ? 1 : 0;
        $edoxaban = isset($_POST['edoxaban']) ? 1 : 0;
        $simvastatina = isset($_POST['simvastatina']) ? 1 : 0;
        $medias = isset($_POST['medias']) ? 1 : 0;

        $sql2 = "INSERT INTO control_medicacion (fecha, atenolol_100mg, felodipino_5mg, lamotrigina_100mg_desayuno, lamotrigina_100mg_cena, edoxaban_60mg, simvastatina_20mg, medias_compresion)
                 VALUES ('$fecha', '$atenolol', '$felodipino', '$lamotrigina_d', '$lamotrigina_c', '$edoxaban', '$simvastatina', '$medias')";
        
        if ($conn->query($sql2) === TRUE) {
            $mensaje = "✅ Datos guardados correctamente.";
            $tipo_alerta = "success";
        } else {
            $mensaje = "Error al guardar medicación: " . $conn->error;
            $tipo_alerta = "danger";
        }
    } else {
        // Error común: Clave duplicada (ya existe registro para hoy)
        if ($conn->errno == 1062) {
            $mensaje = "⚠️ Ya has registrado datos para esta fecha. Usa 'Editar' (próximamente).";
            $tipo_alerta = "warning";
        } else {
            $mensaje = "Error: " . $sql1 . "<br>" . $conn->error;
            $tipo_alerta = "danger";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Mi Salud Personal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f6f9; }
        .card { border-radius: 15px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .form-check-input { width: 1.6em; height: 1.6em; margin-right: 10px; }
        .form-check-label { padding-top: 5px; font-size: 1.1em; }
        .btn-guardar { width: 100%; padding: 15px; font-size: 1.2em; font-weight: bold; border-radius: 12px; }
        .seccion-titulo { color: #0d6efd; font-weight: bold; margin-bottom: 15px; display: flex; align-items: center; }
        .seccion-titulo i { margin-right: 10px; font-size: 1.4em; }
    </style>
</head>
<body>

<div class="container py-3">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">Hola, Luis María</h2>
        <span class="badge bg-primary rounded-pill">Hoy: <?php echo date('d/m'); ?></span>
    </div>

    <?php if ($mensaje): ?>
        <div class="alert alert-<?php echo $tipo_alerta; ?> alert-dismissible fade show" role="alert">
            <?php echo $mensaje; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        
        <div class="mb-3">
            <input type="date" class="form-control form-control-lg text-center fw-bold" name="fecha" value="<?php echo date('Y-m-d'); ?>" required>
        </div>

        <div class="card p-3">
            <h5 class="seccion-titulo"><i class="bi bi-heart-pulse"></i> Biometría</h5>
            <div class="row g-3">
                <div class="col-6">
                    <label class="form-label text-muted small">Peso (kg)</label>
                    <input type="number" step="0.1" class="form-control form-control-lg" name="peso_kg" placeholder="95.0">
                </div>
                <div class="col-6">
                    <label class="form-label text-muted small">Sueño (horas)</label>
                    <input type="number" step="0.5" class="form-control form-control-lg" name="horas_sueno" placeholder="6.0">
                </div>
                <div class="col-6">
                    <label class="form-label text-muted small">Tensión Alta</label>
                    <input type="number" class="form-control" name="tension_sistolica" placeholder="130">
                </div>
                <div class="col-6">
                    <label class="form-label text-muted small">Tensión Baja</label>
                    <input type="number" class="form-control" name="tension_diastolica" placeholder="80">
                </div>
                <div class="col-12 mt-3">
                    <label class="form-label text-muted small">Hinchazón Piernas (1=Nada, 5=Mucha)</label>
                    <div class="d-flex justify-content-between px-2">
                        <span>1</span>
                        <input type="range" class="form-range w-75" min="1" max="5" name="nivel_hinchazon_piernas" value="1">
                        <span>5</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card p-3">
            <h5 class="seccion-titulo"><i class="bi bi-capsule"></i> Medicación</h5>
            
            <div class="mb-3 bg-light p-2 rounded">
                <strong class="text-secondary small text-uppercase">Desayuno</strong>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="atenolol" id="atenolol" checked>
                    <label class="form-check-label" for="atenolol">Atenolol 100mg</label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="felodipino" id="felodipino" checked>
                    <label class="form-check-label" for="felodipino">Felodipino 5mg</label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="lamotrigina_d" id="lamotrigina_d" checked>
                    <label class="form-check-label" for="lamotrigina_d">Lamotrigina 100mg</label>
                </div>
            </div>

            <div class="mb-3 bg-light p-2 rounded">
                <strong class="text-secondary small text-uppercase">Cena / Noche</strong>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="lamotrigina_c" id="lamotrigina_c" checked>
                    <label class="form-check-label" for="lamotrigina_c">Lamotrigina 100mg</label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="edoxaban" id="edoxaban" checked>
                    <label class="form-check-label" for="edoxaban">Edoxaban 60mg (Lixiana)</label>
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="simvastatina" id="simvastatina" checked>
                    <label class="form-check-label" for="simvastatina">Simvastatina 20mg</label>
                </div>
            </div>
            
            <div class="mb-3 bg-light p-2 rounded">
                <strong class="text-secondary small text-uppercase">Otros</strong>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="medias" id="medias" checked>
                    <label class="form-check-label" for="medias">Medias Compresión</label>
                </div>
            </div>
        </div>

        <div class="card p-3">
            <h5 class="seccion-titulo"><i class="bi bi-apple"></i> Hábitos Hoy</h5>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="dieta_baja_sal" id="sal">
                <label class="form-check-label" for="sal">Comí bajo en Sal</label>
            </div>
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="dieta_sin_embutidos" id="embutidos">
                <label class="form-check-label" for="embutidos">Evité Embutidos/Queso</label>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="consumo_fruta" id="fruta">
                <label class="form-check-label" for="fruta">Comí Fruta/Ensalada</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-guardar shadow">
            <i class="bi bi-check-circle-fill"></i> GUARDAR DATOS
        </button>

    </form>
    
    <div class="text-center mt-4 text-muted small">
        <p>App Salud Personal v1.0</p>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>