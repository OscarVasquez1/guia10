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
    
    // 4. Preparar la consulta SQL de inserción
    // NOTA: Recuerda manejar los nombres de la tabla y columnas en minúsculas por estándar de Postgres
    $sql = "INSERT INTO nota (codmateria, carnet, ciclo, notafinal) VALUES (:codmateria, :carnet, :ciclo, :notafinal)";
    $stmt = $conn->prepare($sql);
    
    // 5. Ejecutar pasando el arreglo asociativo con todos los datos
    $resultado = $stmt->execute([
        ':codmateria' => $codmateria,
        ':carnet'     => $carnet,
        ':ciclo'      => $ciclo,
        ':notafinal'  => $notafinal
    ]);
    
    // 6. Responder a Android en formato JSON válido
    if ($resultado) {
        echo json_encode(["resultado" => "ok", "mensaje" => "Registro insertado correctamente"]);
    } else {
        echo json_encode(["resultado" => "error", "mensaje" => "No se pudo insertar el registro"]);
    }

} catch (PDOException $e) {
    // Si la base de datos lanza un error (ej. llave duplicada o tipo de dato incorrecto)
    echo json_encode(["resultado" => "error", "mensaje" => $e->getMessage()]);
}
?>