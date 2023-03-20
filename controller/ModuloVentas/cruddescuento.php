<?php
// Controlador para ingresar regsitros
if (!empty($_POST["btnCrear"])){
 if (!empty($_POST["NombreDescuento"]) and !empty($_POST["PorcentajeDescuento"])){
    

    $nombredescuento=$_POST["NombreDescuento"];
    $porcentaje=$_POST["PorcentajeDescuento"];

    $sql=$conexion->query(" select * from tbl_descuentos where Nombre_descuento='$nombredescuento' ");
        if ($datos=$sql->fetch_object()){
            echo '<div class="alert alert-danger">Este descuento ya existe</div> ';
        }else {
          
            $sql=$conexion->query(" insert into tbl_descuentos(Nombre_descuento, Porcentaje_a_descontar)values('$nombredescuento', '$porcentaje')");
            if ($sql==1){
                ?>
                <script> 
                   alert("Registro Agregado Exitosamente");
                   location.href= "../Formularios/Descuentos.php";
                </SCRipt><?php
                
            } else {
                echo '<div class="alert alert-danger">Ha ocurrido un error al agregar el descuento</div>';
            }

        }

   

 }else{
    echo '<div class="alert alert-danger">Por favor rellena los espacios</div>';
 }
 
}


// Controlador para actualizar registros
if (!empty($_POST["btnEditar"])){
    if (!empty($_POST["NombreDescuento"]) and !empty($_POST["PorcentajeDescuento"])){
       
       $id=$_POST["Id"];
       $nombredescuento=$_POST["NombreDescuento"];
       $porcentaje=$_POST["PorcentajeDescuento"];
   

       $sql=$conexion->query("update tbl_descuentos set Nombre_descuento='$nombredescuento',  Porcentaje_a_descontar='$porcentaje' where Id_Descuento=$id");
               if ($sql==1){
               
                ?>
                <script> 
                  
                   location.href= "../Formularios/Descuentos.php";
                </SCRipt><?php
            
                   
               } else {
                   echo '<div class="alert alert-danger">Ha ocurrido un error al modificar el descuento</div>';
               }
   
        
   
      
   
    }else{
       echo '<div class="alert alert-danger">Por favor rellena los espacios</div>';
    }
    
   }

   // Controlador para borrar registros
   if (!empty($_GET["id2"])){
    $id=$_GET["id2"];
    $sql=$conexion->query("delete from tbl_descuentos where Id_Descuento=$id");
    if ($sql==1){     
    } else {
        echo '<div class="alert alert-success">Error al eliminar el descuento</div>';
    }
   }

?>