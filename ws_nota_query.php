<?php
$codmateria=$_REQUEST['codmateria'];
$carnet=$_REQUEST['carnet'];
$ciclo=$_REQUEST['ciclo'];
///variable
$servername="sql104.infinityfree.com";
$username="if0_41988079";
$dbname= "if0_41988079_guia10db";
$password="gPiCr5HctmGgy";
// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($mysqli->connect_error) {
die("Connection failed: " . $mysqli->connect_error);
}
$consulta ="SELECT CARNET,CODMATERIA,CICLO,NOTAFINAL FROM NOTA WHERE
CARNET='".$carnet."' and CODMATERIA='".$codmateria."'and CICLO='".$ciclo."'";
if ($resultado = $mysqli->query($consulta)) {
$filas=array();
/* obtener un array asociativo */
while ($reg = $resultado->fetch_assoc()) {
$filas[]=$reg;
}
echo json_encode($filas);
/* liberar el conjunto de resultados */
$resultado->free();
}
/* cerrar la conexión */
$mysqli->close();
?>