<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style.css">
  <script src="../JS/script.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <title>GestionUsuario</title>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
  <div class="bg-black p-5 rounded-5 text-secondary shadow" style="width: 40rem">
  <h1>Gestion de usuario</h1>
    <div class="d-flex justify-content-center">
      <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" alt="login-icon" style="height: 7rem" />
    </div>
    <div class="container">
      <form class="form-horizontal" action="" method="post">

        <div class="input-group mt-4">
          <div class="input-group-text bg-light">
           <img src="https://icon-library.com/images/free-user-icon/free-user-icon-26.jpg" alt="username-icon" style="height: 2rem" />
          </div>
          <input class="form-control bg-light" type="text" placeholder="Usuario" name="Usuario" id="inputUser3" maxlength="45" pattern="[A-Z]+" />
        </div>

        <div class="input-group mt-4">
          <input class="form-control bg-light" type="text" placeholder="Nombre" name="Nombre" id="inputUser3" maxlength="60"/>
        </div>
        <br>
        
        <?php session_start();
            require_once("../config/conexion.php");

            $sql = "SELECT Id_Rol, Rol FROM tbl_ms_roles";
            $resultado = $conexion->query($sql);

            // Formulario para mostrar los roles
            echo "<form method='post'>";
            echo "<h5 for='roles'>Rol del usuario:</h5>";
            echo "<select class='form-select form-control bg-light' name='rol id='roles'>";

            // Recorrer los resultados de la consulta y generar una opción para cada rol
            if ($resultado->num_rows > 0) {
              while ($fila = $resultado->fetch_assoc()) {
                $id_rol = $fila["Id_Rol"];
                $rol = $fila["Rol"];
                echo "<option value='{$id_rol}'>{$rol}</option>";
              }
            } else {
              echo "No se han encontrado roles.";
            }

            echo "</select><br>";
            echo "</form>";

            require_once("../controller/gestionUsuario.php");
        ?>  
        

        <br>

		<div class="input-group mt-4">
          <div class="input-group-text bg-light">
           <img src="https://icon-library.com/images/free-e-mail-icon/free-e-mail-icon-12.jpg" alt="username-icon" style="height: 2rem" />
          </div>
          <input class="form-control bg-light" type="email" placeholder="john@example.com" name="Email" id="floatingInputEmail" />
        </div>
        <br>

        <div class="input-group mt-1">
          <div class="input-group-text bg-light">
            <img src="https://icon-library.com/images/show-password-icon/show-password-icon-7.jpg" alt="password-icon" style="height: 2rem" />
          </div>
          <input class="form-control bg-light" type="password" placeholder="Contraseña" name="Clave" id="inputPassword3" maxlength="15" minlength="5" required />
        </div>
        <br>

        <div style="font-size: 20px" class="input-group mt-1">
          <h5>Fecha de creacion   : </h5>
          <?php 
          date_default_timezone_set("America/Tegucigalpa");// creacion automatica de la hora por el sistema 
            echo $fecha1 = date("d-m-y");
           ?>
        </div>
        <br>

        <div class="input-group mt-1">
          <h5>Fecha de vencimiento  :</h5> 
          <input class="form-control bg-light" type="date" lable="Fecha creación"  name="Fecha1" id="Fecha"/>
        </div>
        <br>

        <div style="font-size: 20px">
                <label for="estado">Estado del usuario</label>
                <select name="Estados" id="estado">
                    <option value="Seleccione">Seleccione un estado</option>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                    <option value="Bloqueado">Bloqueado</option>
                    <option value="Nuevo">Nuevo</option>
                </select>
        </div>

        <br>
        <div class="d-flex gap-1 justify-content-center mt-1">
          <div id="btnResetear">
            <input type="submit" name="btnResetear" value="Resetear" class="btn btn-info text-white w-100 mt-4 fw-semibold shadow-sm">
          </div>
        </div>
		<br>


        <?php require_once("../config/conexion.php");
        require_once("../controller/gestionUsuario.php"); ?>
      </form>
    </div>
</body>

</html>
<?php ob_end_flush(); ?>