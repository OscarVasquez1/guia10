<?php
// 1. Capturar los parámetros enviados desde Android
$codmateria = $_REQUEST['codmateria'];
$carnet     = $_REQUEST['carnet'];
$ciclo      = $_REQUEST['ciclo'];
$notafinal  = $_REQUEST['notafinal'];

// 2. CREDENCIALES DE TU BASE DE DATOS EN RENDER (Rellena aquí con tus datos)
$host     = "dpg-d8igm4u7r5hc73ct51fg-a"; 
$database = "guia10db";
$user     = "guia10db_user";
$password = "TH2iNNxbMtKC5PacQztXHdE6VisKV4oW";

try {
    // 3. Crear la conexión universal configurada para PostgreSQL
    $conn = new PDO("pgsql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 4. Preparar la consulta SQL de actualización de forma segura
    // NOTA: Mantenemos el estándar de PostgreSQL con la tabla y columnas en minúsculas
    $sql = "UPDATE nota SET notafinal = :notafinal 
            WHERE carnet = :carnet AND codmateria = :codmateria AND ciclo = :ciclo";
    
    $stmt = $conn->prepare($sql);
    
    // 5. Ejecutar pasando todos los parámetros correspondientes
    $stmt->execute([
        ':notafinal'  => $notafinal,
        ':carnet'     => $carnet,
        ':codmateria' => $codmateria,
        ':ciclo'      => $ciclo
    ]);
    
    // 6. Verificar si se modificó alguna fila (Equivalente a affected_rows)
    if ($stmt->rowCount() >= 1) {
        echo json_encode(["resultado" => "1", "mensaje" => "Registro actualizado correctamente"]);
    } else {
        echo json_encode(["resultado" => "0", "mensaje" => "Registro no se actualizo"]);
    }

} catch (PDOException $e) {
    // Si ocurre un error en la BD, lo devolvemos limpio en JSON
    echo json_encode(["resultado" => "0", "mensaje" => "Error: " . $e->getMessage()]);
}
?>