<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Finalmente, destruir la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión o a cualquier otra página deseada.
header("Location: index.html");
exit;
?>