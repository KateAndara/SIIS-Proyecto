<!--Buscador-->
<?php 
include '../components/header.components.php';
    include_once "../config/conexion2.php"; 
    //Sentencia para buscar los datos de 1 usuario en la tabla usuarios
    if(isset($_GET["search"])){
      $sentencia = $conexion -> query("SELECT * from tbl_ms_usuarios WHERE usuario LIKE '%".$_GET["search"]."%' OR id_Usuario =  ".intval($_GET["search"])."");
    }else{
      //Sentencia para jalar los datos de la tabla usuarios 
      $sentencia = $conexion -> query("SELECT * from tbl_ms_usuarios");
    }
    
    $usuario = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<div class="col-md-12 cards-white" style="margin: 0 auto; width: 115%; max-width: none; margin-left: -20px;">

    
<!-- inicio alerta -->
            <?php 
            if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Rellena todos los campos.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'guardado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Listo!</strong> Usuario guardado correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   
            
            

            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'error'){
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Vuelve a intentar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?>   



            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado'){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Actualizado!</strong> Los datos del usuario fueron actualizados correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 


            <?php 
                if(isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado'){
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Eliminado!</strong> Usuario eliminado correctamente.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php 
                }
            ?> 
  
            <div class="row">
                <div class="col-12 text-center">
                    <h3>
                      Lista De Usuarios
                    </h3>
                </div>
            </div>
            <br>
            <!-- fin alerta -->

  <!--Boton para crear usuario-->
  <!--Bucador-->
     <form method="GET" action="GestionUsuarios.php">
      <div class="input-group mb-3">
          <input name="search" type="text" 
          value="<?php 
            echo isset($_GET["search"]) ? $_GET["search"] : ''
          ?>"
          class="form-control" placeholder="Buscar Usuario" aria-label="Buscar Usuario" aria-describedby="button-addon2">
          <div class="input-group-append" style="margin: 0 18px;">
            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Buscar</button>
            <button style="background-color:  #147c4c;"><a href="GestionUsuario.php" type="submit"  class="rounded" style="color: white; float: right; margin-left: 10px;">Agregar Usuario</a></button>
             <button class="rounded" style="background-color: #fff; color: dark; float: right;"  onclick="PDFProductoTerminadoMP('+MisItems[i].Id_Producto_Terminado_Mp +')">Generar PDF</button>
          </div>
        </div>
    </form>
    
 

<!--Tabla en la que se muetran todos los de la tabla usuario-->
<table class="table table-hover " style="color:black; width: 70rem;" >
                        <thead>
                            <tr>
                                <th scope="col">ID USUARIO</th>
                                <th scope="col">USUARIO</th>
                                <th scope="col">NOMBRE</th>
                                <th scope="col">ESTADO</th>
                                <th scope="col">FECHA DE ULTIMA CONEXCION</th>
                                <th scope="col">DNI</th>
                                <th scope="col">CORREO ELECTRONICO</th>
                                <th scope="col" colspan="3">OPCIONES</th>
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
                           <td><a class="btn btn-outline-secondary"  style="background-color: #2D7AC0; color: white; display: inline-block; width: 68px;" href="EditarUsuario.php?Id_Usuario=<?php echo $dato->Id_Usuario; ?>">Editar</a></td>
                           <td><a onclick="return confirm('Estas seguro de eliminar el usuario?');" class="btn btn-outline-secondary" style="background-color: #D6234A; color: white; display: inline-block; width: 80px;" href="../controller/DeleteUsuario.php?Id_Usuario=<?php echo $dato->Id_Usuario; ?>">Eliminar</a></td>
                           <!--se mostraran los datos completos de los usuarios usando el modals-->
                           <td> <a onclick="showModal(
                            '<?php echo $dato->Id_Usuario; ?>',
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
                           )" class="btn btn-outline-secondary" style="background-color:  #147c4c; color: white; float: right; margin-left: 1px; width: 90px">Ver mas</a>
                           </td></td>
                         </tr>
              <!--Mostrara un mensaje cuando no se encuentre un usuario en el buscador-->
              <?php }  if(!$usuario) { ?>
              <tr>
                <td style=" text-align: center; " colspan="8">No se encontraron registros</td>
              </tr>
              <?php }  ?>

 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button onclick="hidde()" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div id="datauser"></div>
      </div>
      <div class="modal-footer">
        <button onclick="hidde()" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>                      

<!--Mostrar los datos con el modal en la pantalla emergente-->
<script>
  function showModal(Id_Usuario,Id_Rol,Id_Cargo, Usuario, Nombre, Estado, Contrasena, Fecha_ultima_conexion, Preguntas_contestadas, Primer_ingreso, Fecha_vencimiento, DNI, Correo_Electronico, Creado_por, Fecha_creacion, Modificado_por, Fecha_modificacion){
    let data = `<table>
    <tr>
        <td>Id_Usuario</td>
        <td>${ Id_Usuario }</td>
      </tr>
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
      <tr>
        <td>Primer_ingreso</td>
        <td>${ Primer_ingreso }</td>
      </tr>
      <tr>
        <td>Fecha_vencimiento</td>
        <td>${ Fecha_vencimiento }</td>
      </tr>
      <tr>
        <td>DNI</td>
        <td>${ DNI }</td>
      </tr>
      <tr>
        <td>Correo_Electronico</td>
        <td>${ Correo_Electronico }</td>
      </tr>
      <tr>
        <td>Creado_por</td>
        <td>${ Creado_por }</td>
      </tr>
      <tr>
        <td>Fecha_creacion</td>
        <td>${ Fecha_creacion }</td>
      </tr>
      <tr>
        <td>Modificado_por</td>
        <td>${ Modificado_por }</td>
      </tr>
      <tr>
        <td>Fecha_modificacion</td>
        <td>${ Fecha_modificacion }</td>
      </tr>
    </table>`;
    
    $('#exampleModal').modal('show');
    $('#datauser').html(data);
  }
 
function hidde(){
  $('#exampleModal').modal('hide')
}
</script>
<?php include '../components/footer.components.php' ?>
</div>                   
