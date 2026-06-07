<?php
// 1. Capturar los parámetros enviados desde Android
$codmateria = $_REQUEST['codmateria'];
$carnet     = $_REQUEST['carnet'];
$ciclo      = $_REQUEST['ciclo'];

// 2. CREDENCIALES DE TU BASE DE DATOS EN RENDER (Rellena aquí con tus datos)
$host     = "dpg-d8igm4u7r5hc73ct51fg-a"; 
$database = "guia10db";
$user     = "guia10db_user";
$password = "TH2iNNxbMtKC5PacQztXHdE6VisKV4oW";

try {
    // 3. Crear la conexión universal configurada para PostgreSQL
    $conn = new PDO("pgsql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 4. Preparar la consulta SQL de eliminación de forma segura
    // NOTA: Pasamos las tablas y columnas a minúsculas por estándar de PostgreSQL
    $sql = "DELETE FROM nota WHERE carnet = :carnet AND codmateria = :codmateria AND ciclo = :ciclo";
    $stmt = $conn->prepare($sql);
    
    // Ejecutar pasando los tres parámetros requeridos
    $stmt->execute([
        ':carnet'     => $carnet,
        ':codmateria' => $codmateria,
        ':ciclo'      => $ciclo
    ]);
    
    // 5. Responder a Android en un formato JSON estructurado y limpio
    // Corregimos el "{resultado:}" viejo por un JSON válido que Android pueda parsear sin errores
    echo json_encode(["resultado" => "exito"]);

} catch (PDOException $e) {
    // Si algo falla, devolvemos el error en formato JSON
    echo json_encode(["resultado" => "error", "error_servidor" => $e->getMessage()]);
}
?>