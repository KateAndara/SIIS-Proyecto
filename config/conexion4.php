<?php
$host = "localhost";
$user = "SIIS2";
$password = "12345";
$database_name = "proyecto-siis";
$conn = mysqli_connect($host, $user, $password, $database_name);

// Verificar la conexión
if (mysqli_connect_errno()) {
   echo "Error en la conexión a MySQL: " . mysqli_connect_error();
   exit();
}

?>