<?php
//Opción 1
$conexion=new mysqli("localhost", "root","123456","proyecto", "3306");
$conexion->set_charset("utf8");

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
?>