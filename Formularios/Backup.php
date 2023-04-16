<?php 
include '../components/header.components.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

</head>
<body>
    
<h1 style="color: black">Gestión de Base de Datos</h1><br>


<div class="border border-3 p-3">
  <h2 style="color: black">Realizar Backup</h2>

  <form method="post" action="../controller/backup.php">
    <div class="col-5">
      <br>
      <button type="submit" name="crear_backup" class="btn btn-success">Crear backup</button>
    </div>
  </form>
</div>
<br>
<br>
<div class="border border-3 p-3">
<h2 style="color: black;">Realizar Restore</h2>
<div class="row justify-content-center">
		<div class="col-sm-6">
			<div class="card">
				<div class="card-body">
					<h3>Credenciales de la base de datos</h3>
					<br>
					<form method="POST" action="../controller/restore.php" enctype="multipart/form-data">
					    <div class="form-group row">
					      	<label for="sql" class="col-sm-3 col-form-label">Archivo</label>
					      	<div class="col-sm-9">
					        	<input type="file" class="form-control-file" id="sql" name="sql" placeholder="base de datos que deseas restaurar" required>
					      	</div>
					    </div>
					    <button type="submit" class="btn btn-primary" name="restore">Restaurar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<br>
<br>

<!-- JavaScript Bundle with Popper -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>
