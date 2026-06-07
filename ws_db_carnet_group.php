<?php
// 1. Capturar el parámetro enviado desde Android
$carnet = $_REQUEST['carnet'];

// 2. CREDENCIALES DE TU BASE DE DATOS EN RENDER (Rellena aquí con tus datos)
$host     = "dpg-d8igm4u7r5hc73ct51fg-a"; 
$database = "guia10db";
$user     = "guia10db_user";
$password = "TH2iNNxbMtKC5PacQztXHdE6VisKV4oW";

try {
    // 3. Crear la conexión universal configurada para PostgreSQL
    $conn = new PDO("pgsql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    $consulta = "SELECT carnet, AVG(notafinal) AS promedio FROM nota WHERE carnet = :carnet GROUP BY carnet";
    $stmt = $conn->prepare($consulta);
    
    // Ejecutar pasando el parámetro del carnet
    $stmt->execute([':carnet' => $carnet]);
    
    // 5. Obtener los resultados como un array asociativo (Tus mismas variables)
    $filas = array();
    while ($reg = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $filas[] = $reg;
    }
    
    // 6. Devolver el JSON limpio a Android
    echo json_encode($filas);

} catch (PDOException $e) {
    // Si algo falla, devolvemos el error estructurado en JSON
    echo json_encode(["error_servidor" => $e->getMessage()]);
}
?>