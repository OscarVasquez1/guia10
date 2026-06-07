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
    
    // 4. Preparar la consulta SQL de forma segura con parámetros nombrados
    // NOTA: Pasamos las columnas y tablas a minúsculas por compatibilidad estricta con PostgreSQL
    // Mapeamos los alias en minúsculas para mantener consistencia con los nombres de campos de tu BD
    $consulta = "SELECT carnet, codmateria, ciclo, notafinal FROM nota 
                 WHERE carnet = :carnet AND codmateria = :codmateria AND ciclo = :ciclo";
    
    $stmt = $conn->prepare($consulta);
    
    // Ejecutar la consulta inyectando los tres parámetros de búsqueda
    $stmt->execute([
        ':carnet'     => $carnet,
        ':codmateria' => $codmateria,
        ':ciclo'      => $ciclo
    ]);
    
    // 5. Obtener los resultados como un array asociativo
    $filas = array();
    while ($reg = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $filas[] = $reg;
    }
    
    // 6. Devolver el JSON limpio a tu aplicación de Android
    echo json_encode($filas);

} catch (PDOException $e) {
    // Si la BD tira error, lo mandamos estructurado en JSON para no romper el parser de Android
    echo json_encode(["error_servidor" => $e->getMessage()]);
}
?>