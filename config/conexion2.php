<?php
//Conexion usan el PDO
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