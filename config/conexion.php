<?php
//Opción 1
//$conexion=new mysqli("localhost", "SIIS2","12345","proyecto-siis", "3306");
//$conexion->set_charset("utf8");

// Opción 2
/*$host = "localhost";
$bd = "proyecto";
$usuario = "root";
$clave = "123456";

$conexion = mysqli_connect($host, $usuario, $clave, $bd);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
echo "Conexión exitosa";
mysqli_close($conexion);*/

//Opción 3
$contrasena = "12345";
$usuario = "SIIS2";
$nombre_bd = "proyecto-siis";

try {
	$conexion = new PDO (
		'mysql:host=localhost;
		dbname='.$nombre_bd,
		$usuario,
		$contrasena,
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
	);
} catch (Exception $e) {
	echo "Problema con la conexion: ".$e->getMessage();
}
?>