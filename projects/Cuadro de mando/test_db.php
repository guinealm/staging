<?php
// Activar visualización de errores (Solo para pruebas)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Test de Conexión</h1>";

// TUS DATOS (Cópialos con cuidado)
$servername = "localhost"; 
$username   = "u123456789_guinealm"; // Asegúrate de incluir el prefijo u...
$password   = "45%eeWWW";            // Cuidado con espacios extra al copiar
$dbname     = "u123456789_cuadro_mando"; 

// Intentar conectar
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Error de conexión: " . $conn->connect_error);
    }
    
    echo "<h3 style='color:green'>✅ ¡ÉXITO! Conexión establecida.</h3>";
    echo "Hostinger acepta las credenciales.";
    
} catch (Exception $e) {
    echo "<h3 style='color:red'>❌ FALLO</h3>";
    echo "<strong>Mensaje:</strong> " . $e->getMessage() . "<br><br>";
    
    echo "<strong>Posibles causas:</strong><ul>";
    echo "<li>La contraseña es incorrecta (cuidado con mayúsculas/minúsculas).</li>";
    echo "<li>El usuario no tiene permisos sobre esa base de datos (Revisar en Hostinger > Bases de Datos).</li>";
    echo "<li>El servidor no es 'localhost' (mira en Hostinger el apartado 'MySQL Host').</li>";
    echo "</ul>";
}
?>