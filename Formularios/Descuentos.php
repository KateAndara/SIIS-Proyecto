
<?php 
include '../components/header.components.php';

if(isset($_GET["search"])){
  $sentencia = $conexion -> query("SELECT * from tbl_descuentos WHERE Nombre_descuento LIKE '%".$_GET["search"]."%' OR id_Descuento =  ".intval($_GET["search"])."");
}else{
  //Sentencia para jalar los datos de la tabla usuarios 
  $sentencia = $conexion -> query("SELECT * from tbl_descuentos");
}
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descuentos</title>
    <!-- CSS only -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
   
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../JS/ProductoTerminadoMP.js"></script>
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px;">
        <div class="consulta mt-4">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>
                        Lista de Descuentos para las Ventas
                    </h3>
                </div>
            </div>
            <div style="margin: 0 18px;">
            <form id="form-busqueda" method="GET" action="Descuentos.php">
                
                    <input name="search" type="text" class="rounded" style="border: 2px solid black;" 
                       value="<?php 
                       echo isset($_GET["search"]) ? $_GET["search"] : ''
                     ?>" placeholder="Buscar...">
                   <button style="background-color: black; color: white;" class="rounded" id="btn-busqueda" type="submit">Buscar</button>
                
            </form>

            <a  type="submit" class="btn btn-success btn-lg float-right" href="../Formularios/CrearDescuentos.php" style="background-color:  #147c4c; color: white; float: right; margin-left: 10px;" >Agregar</a>
            <a type="submit" class="btn btn-danger btn-lg float-right" style="background-color: #FF0000; color: White; float: right;"  onclick="">Generar PDF</a>
            </div>
            
            <script>
              function eliminar(){
                var respuesta=confirm("¿Estas seguro que deseas eliminar?");
                return respuesta
              }  
            </script>    
            <!-- Modal -->
            <div class="modal fade" id="modalForm" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                     <!-- Modal Header -->
                     <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Nuevo Descuento</h4>
                      </div>
            
                      <!-- Modal Body -->
                  <div class="modal-body">
                     <p class="statusMsg"></p>
                          <form  role="form" action="" method="post">
                          
                              <div class="form-group">
                                  <label for="inputName">Nombre del Descuento</label>
                                  <input type="text" class="form-control" name="NombreDescuento" id="inputName" placeholder="Al por mayor..." maxlength="100"/>
                              </div>
                              <div class="form-group col-3">
                                  <label for="inputporcentaje">Porcentaje del Descuento</label>
                                  <input type="number" class="form-control" name="PorcentajeDescuento" id="inputporcentaje" placeholder="1,2,3,4,5..."/>
                              </div>
                              <br>
                              <button type="button" class="btn btn-danger" data-dismiss="modal">CERRAR</button>
                              <button type="b" name="btnCrear" id="btnCrear" class="btn btn-primary submitBtn" onclick="ValidarForm()">GUARDAR</button>
                            
                          </form>

                   </div>
            
                     
                 </div>
                </div>
            </div>
            <?php
                 include "../config/conexion.php";
                 include "../controller/ModuloVentas/cruddescuento.php";
            ?>
            <!-- Table Body -->
            <div class="box-body">
                <div class="table table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID DESCUENTO</th>
                                <th>NOMBRE DE DESCUENTO</th>
                                <th>PORCENTAJE A DESCONTAR</th>
                                
                                <th>OPCIONES</th>
                            </tr>
                        </thead>

                        <tbody >
                             <?php
                                include "../config/conexion.php";
                                if(isset($_GET["search"])){
                                    $sql = $conexion -> query("SELECT Id_Descuento, Nombre_descuento, concat(Porcentaje_a_descontar,' ', '%') as Porcentaje from tbl_descuentos WHERE Nombre_descuento LIKE '%".$_GET["search"]."%' OR Id_Descuento =  ".intval($_GET["search"])."");
                                  }else{
                                $sql=$conexion->query("select Id_Descuento, Nombre_descuento, concat(Porcentaje_a_descontar,' ', '%') as Porcentaje  from tbl_descuentos");
                                  }
                                while($datos=$sql->fetch_object()){
                             ?> 
                             <tr>
                             <td><?= $datos->Id_Descuento ?> </td>
                             <td><?= $datos->Nombre_descuento ?> </td>
                             <td><?= $datos->Porcentaje ?> </td>
                             <td>
                             <a class="btn btn-info " href="EditarDescuento.php?id=<?=$datos->Id_Descuento?>" style="background-color: #2D7AC0; color: white; display: inline-block; width: 67px;" onclick="">Editar</a>
                             <a class="btn btn-danger " href="Descuentos.php?id2=<?=$datos->Id_Descuento ?>" style="background-color: #D6234A; color: white; display: inline-block; width: 76px;"  onclick="return eliminar()">Eliminar</a>
                             </td> 
                             </tr>

                             <?php
                             }
                             ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
 
<!-- Validación de Formularios -->    
<script>
function ValidarForm(){
    var reg = /^[0-9]+$/i;
    var name = $('#inputName').val();
    var porcentaje = $('#inputporcentaje').val();
    if(name.trim() == '' ){
        alert('Por favor rellene este campo.');
        $('#inputName').focus();
        return false;
    }else if(porcentaje.trim() == '' ){
        alert('Por favor rellene este campo.');
        $('#inputporcentaje').focus();
        return false;
    }else if(porcentaje.trim() != '' && !reg.test(porcentaje)){
        alert('El porcentaje tiene que tener un valor numerico entero.');
        $('#inputporcentaje').focus();
        return false;
    }
}
</script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
