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
                           <td>
                           <a class="text-success" href="EditarUsuario.php?Id_Usuario=<?php echo $dato->Id_Usuario; ?>"><i class="bi bi-pencil-square"></i></a>
                           <a onclick="return confirm('Estas seguro de eliminar el usuario?');" class="text-danger" href="../controller/DeleteUsuario.php?Id_Usuario=<?php echo $dato->Id_Usuario; ?>"><i class="bi bi-trash"></i></a>
                           <a onclick="showModal(
                            '<?php echo $dato->Id_Rol; ?>',
                                '<?php echo $dato->Id_Cargo; ?>',
                                '<?php echo $dato->Usuario; ?>',
                                '<?php echo $dato->Nombre; ?>',
                                '<?php echo $dato->Estado; ?>',
                                '<?php echo $dato->Contraseña; ?>',
                                '<?php echo $dato->Fecha_ultima_conexion; ?>',
                                '<?php echo $dato->Preguntas_contestadas; ?>',
                                '<?php echo $dato->Primer_ingreso; ?>',
                                '<?php echo $dato->Fecha_vencimiento; ?>',
                                '<?php echo $dato->DNI; ?>',
                                '<?php echo $dato->Correo_Electronico; ?>',
                                '<?php echo $dato->Creado_por; ?>',
                                '<?php echo $dato->Fecha_creacion; ?>',
                                '<?php echo $dato->Modificado_por; ?>',
                                '<?php echo $dato->Fecha_modificacion; ?>'
                           )" class="text-success" ><i class="bi bi-view-list"></i></a>
                           </td>
                         </tr>

                        <?php } ?>





 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div id="datauser"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>                      



<script>
  function showModal(Id_Rol,Id_Cargo, Usuario, Nombre, Estado, Contrasena, Fecha_ultima_conexion, Preguntas_contestadas, Primer_ingreso, Fecha_vencimiento, DNI, Correo_Electronico, Creado_por, Fecha_creacion, Modificado_por, Fecha_modificacion){
    let data = `<table>
      <tr>
        <td>Id_Rol</td>
        <td>${ Id_Rol }</td>
      </tr>
      <tr>
        <td>Id_Cargo</td>
        <td>${ Id_Cargo }</td>
      </tr>
      <tr>
        <td>Id_Cargo</td>
        <td>${ Usuario }</td>
      </tr>
      <tr>
        <td>Nombre</td>
        <td>${ Nombre }</td>
      </tr>
      <tr>
        <td>Estado</td>
        <td>${ Estado }</td>
      </tr>
      <tr>
        <td>Contraseña</td>
        <td>${ Contrasena }</td>
      </tr>
      <tr>
        <td>Fecha_ultima_conexion</td>
        <td>${ Fecha_ultima_conexion }</td>
      </tr>
      <tr>
        <td>Preguntas_contestadas</td>
        <td>${ Preguntas_contestadas }</td>
      </tr>
    </table>`;
    
    $('#exampleModal').modal('show');
    $('#datauser').html(data);
  }
</script>





</div>                   
<?php include '../components/footer.components.php' ?>