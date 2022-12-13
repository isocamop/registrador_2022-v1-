<?php
session_start();
	$host_db = "localhost";
	$user_db = "root";
	$pass_db = "12345678";
	$db_name = "registrador";
	$tbl_name = "usuario";
	$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name); 
	
if ($conexion->connect_error) {
	die("La conexion falló: " . $conexion->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM $tbl_name WHERE Nombre = '$username'";

$result = $conexion->query($sql); 

if ($result->num_rows > 0) {
}
	
$row = $result->fetch_array(MYSQLI_ASSOC);
if ($password == $row['clave']) {
	$_SESSION['loggedin'] = true;
	$_SESSION['Nombre'] = $username;
	$_SESSION['start'] = time();
	$_SESSION['expire'] = $_SESSION['start'] + (5 * 60); 
	include("PRESENTACION.html");
} else {
	echo "Nombre o Contraseña estan incorrectos.";
	echo "<br><a href='index.html'>Volver a Intentarlo</a>"; 
}
mysqli_close($conexion);
?>