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
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "DELETE FROM NOTA WHERE carnet='".$carnet."' AND
codmateria='".$codmateria."' AND ciclo='".$ciclo."'";
if ($conn->query($sql) === TRUE) {
echo "{resultado:}";
} else {
echo "Error: " . $sql . "<br>" . $conn->error;
}
echo $codmateria || $carnet || $ciclo || $notafinal;
$conn->close();
?>