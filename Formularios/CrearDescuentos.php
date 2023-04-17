
<?php 
include '../components/header.components.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Nuevo Descuento</title>
    <!-- CSS only -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../JS/script.js"></script>

</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px;">
        <div class="consulta mt-4">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>
                        Nuevo Descuento
                    </h3>
                </div>
            </div>
            
   
                    <!-- form card login -->
                    <div class="card rounded shadow shadow-sm">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" action="" autocomplete="off" id="formDescuento" novalidate="" method="post">
                            <?php
                                include "../config/conexion.php";
                                include "../controller/ModuloVentas/cruddescuento.php";
                            ?>
                                <div class="form-group col-md-6">
                                    <label for="uname1">Nombre del Descuento</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="NombreDescuento" id="NombreDescuento" placeholder="Descuento..." required="">
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo.</div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Porcentaje del Descuento</label>
                                    <input type="number" class="form-control form-control-lg rounded-0" name="PorcentajeDescuento" id="PorcentajeDescuento" placeholder="1,2,3,4,5..." onkeydown="this.value=Numeros(this.value)" required="" >
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo</div>
                                  
                                </div>

                               
                                <br>
                                <a type="submit" href="Descuentos.php" class="btn btn-danger btn-lg float-right" id="btncancelar">CANCELAR</a>
                                <button type="submit" class="btn btn-success btn-lg float-right" name="btnCrear" id="btnCrear" onclick="ValidarForm()" value="ok">CREAR</button>
                                
                                <script>
                                      $("#btnCrear").click(function(event) {
 
                                      //Fetch form to apply custom Bootstrap validation
                                      var form = $("#formDescuento")
 
                                      if (form[0].checkValidity() === false) {
                                           event.preventDefault()
                                           event.stopPropagation()
                                      }

                                      form.addClass('was-validated');
                                      });    
                                </script>
                                <script>
                                      function Numeros(string){//Solo numeros
                                         var out = '';
                                         var filtro = '0123456789-';//Caracteres validos
	
                                        //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
                                         for (var i=0; i<string.length; i++)
                                         if (filtro.indexOf(string.charAt(i)) != -1) 
                                         //Se añaden a la salida los caracteres validos
	                                       out += string.charAt(i);
	
                                         //Retornar valor filtrado
                                         return out;
                                      }   
                               </script>  
                                <!-- Validación de Formularios -->    

                            </form>
                        </div>
                        <!--/card-block-->
                    </div>
                    <!-- /form card login -->

                </div>
        </div>
    </div>
      

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
