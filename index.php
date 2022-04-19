<?php 
require 'BDconect.php';
$clave_asistencia = $_GET['asistencia'];
$sql = "SELECT * FROM asistencias WHERE clave  = '$clave_asistencia'"; 
$query = $connect -> prepare($sql); 
$query -> execute(); 
$result = $query -> fetch(PDO::FETCH_ASSOC);

$query->connect = null;



if($result){
	include 'plantilla_qr.php';
}else{
	echo "No existe asistencia para ese codigo";
}
?>
