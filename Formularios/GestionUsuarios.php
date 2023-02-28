<?php include '../components/header.components.php';
    include_once "../config/conexion2.php"; 
    $sentencia = $conexion -> query("select * from tbl_ms_usuarios");
    $usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="col-md-12 cards-white">

    <div class="input-group mb-3">
      <input type="text" class="form-control" placeholder="Buscar Usuario" aria-label="Buscar Usuario" aria-describedby="button-addon2">
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Buscar</button>
      </div>
    </div>



 


    <a href="GestionUsuario.php" type="submit"  class="btn btn-primary">Crear usuario</a>

<table class="table table-sm table-dark" style="w" >
                        <thead>
                            <tr>
                                <th scope="col">Id Usuario</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Fecha de ultima conexión</th>
                                <th scope="col">DNI</th>
                                <th scope="col">Correo electronico</th>
                                <th scope="col" colspan="2">Opciones</th>
                            </tr>
                        </thead>

                        <?php 
                                foreach($usuario as $dato){ 
                         ?>
                         <tr>
                           <td scope="row"><?php echo $dato->Id_Usuario; ?></td>
                           <td><?php echo $dato->Usuario; ?></td>
                           <td><?php echo $dato->Nombre; ?></td>
                           <td><?php echo $dato->Estado; ?></td>
                           <td><?php echo $dato->Fecha_ultima_conexion; ?></td>
                           <td><?php echo $dato->DNI; ?></td>
                           <td><?php echo $dato->Correo_Electronico; ?></td>
                           <td></td>
                         </tr>

                        <?php } ?>





</div>                   
<?php include '../components/footer.components.php' ?>