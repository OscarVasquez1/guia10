<?php
// 1. Capturar los parámetros enviados desde Android
$year  = $_REQUEST['year'];
$month = $_REQUEST['month'];
$day   = $_REQUEST['day'];

// 2. CREDENCIALES DE TU BASE DE DATOS EN RENDER (Rellena aquí con tus datos)
$host     = "dpg-d8igm4u7r5hc73ct51fg-a"; 
$database = "guia10db";
$user     = "guia10db_user";
$password = "TH2iNNxbMtKC5PacQztXHdE6VisKV4oW";

try {
    // 3. Crear la conexión universal configurada para PostgreSQL
    $conn = new PDO("pgsql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Armamos la fecha tal cual la tenías en tu código original
    $fecha_limite = $year . "-" . $month . "-" . $day;
    
    // 4. Preparar la consulta SQL de forma segura
    // NOTA: En PostgreSQL, los nombres de las tablas y campos se escriben en minúsculas por estándar
    $consulta = "SELECT * FROM materia WHERE fecha_modificado > :fecha";
    $stmt = $conn->prepare($consulta);
    
    // Ejecutar la consulta pasando el parámetro de la fecha
    $stmt->execute([':fecha' => $fecha_limite]);
    
    // 5. Obtener los resultados como un array asociativo (Tus mismas variables)
    $filas = array();
    while ($reg = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $filas[] = $reg;
    }
    
    // 6. Devolver el JSON limpio a Android Studio
    echo json_encode($filas);

} catch (PDOException $e) {
    // Si algo falla internamente, devolvemos el error estructurado en JSON 
    // para que Android no se caiga intentando leer HTML
    echo json_encode(["error_servidor" => $e->getMessage()]);
}
?>