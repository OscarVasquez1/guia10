<?php
$codmateria=$_REQUEST['codmateria'];
$carnet=$_REQUEST['carnet'];
$ciclo=$_REQUEST['ciclo'];
$notafinal=$_REQUEST['notafinal'];
///variable
$servername="sql104.infinityfree.com";
$username="if0_41988079";
$dbname= "if0_41988079_guia10db";
$password="gPiCr5HctmGgy";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "UPDATE NOTA SET notafinal=".$notafinal." WHERE carnet='".$carnet."' AND
codmateria='".$codmateria."' AND ciclo='".$ciclo."'";
$resultado = $conn->query($sql);
if ($resultado) {
if ($conn->affected_rows>=1){
echo json_encode(["resultado" => "1","mensaje" => "Registro actualizado correctamente"]);
}
else
{
echo json_encode(["resultado" => "0","mensaje" => "Registro no se actualizo"]);
}
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
echo $codmateria || $carnet || $ciclo || $notafinal;
$conn->close();
?>