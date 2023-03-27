<?php 
include '../components/header.components.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Nueva Venta</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px;">
        <div class="consulta mt-4">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>
                        Nueva Venta
                    </h3>
                </div>
            </div>
            
   
                    <!-- form card login -->
                    <div class="card rounded shadow shadow-sm">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="formVenta" novalidate="" method="POST">
                            <div class="row justify-content-center">
                                <div class="form-group col-md-6">
                                    <label for="uname1">Cliente</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" name="uname1" id="uname1" required="">
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo.</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Numero de Factura</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" id="fact1" required="" >
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo</div>
                                </div>
                                
                            </div> 
                            <div class="row justify-content-center">   
                                <div class="form-group col-md-6">
                                    <label>Producto</label>
                                    <select name="Producto" id="producto" class="form-control">
                                           <option value="javascript">Chuleta</option>
                                           <option value="php">Bistec</option>
                                           <option value="java">Chorizo</option>
                                           <option value="golang">Costilla</option>
                                           <option value="python">Carne Molida</option>
                                           
                                    </select> 
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Fecha</label>
                                    <input type="date" class="form-control form-control-lg rounded-0" id="fec1" required="" >
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo</div>
                                </div>
                            </div>
                            <div class="row justify-content-center">      
                                <div class="form-group col-md-6">
                                    <label>RTN</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" id="rtn1" required="" >
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Talonario</label>
                                    <input type="text" class="form-control form-control-lg rounded-0" id="tal1" required="" >
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo</div>
                                </div>
                            </div>
                            <div class="row justify-content-center">  
                                <div class="form-group col-md-6">
                                    <label>Cantidad</label>
                                    <input type="number" class="form-control form-control-lg rounded-0" id="cnt1" required="" >
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Precio</label>
                                    <input type="number" class="form-control form-control-lg rounded-0" id="prc1" required="" >
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo</div>
                                </div>
                            </div>
                                <div class="form-group col-md-6">
                                    <label>Estado de Venta</label>
                                    <select name="Estado" id="estado" class="form-control">
                                           <option value="javascript">PRE VENTA</option>
                                           <option value="php">PENDIENTE DE PAGO</option>
                                           <option value="java">FACTURADO</option>                         
                                    </select> 
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo</div>
                                </div>
                            <br>     
                                <div class="form-group col-md-6">
                                    <label>Subtotal:</label>
                                    <label>3500</label>
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo</div>
                                </div>
                            <br>    
                            <div class="row justify-content-center">     
                                <div class="form-group col-md-6">
                                    <label>Descuento</label>
                                    <input type="number" class="form-control form-control-lg rounded-0" id="prc1" required="" >
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo</div>
                                </div>
                               
                                <div class="form-group col-md-6">
                                    <label>Impuesto</label>
                                    <input type="number" class="form-control form-control-lg rounded-0" id="prc1" required="" >
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo</div>
                                </div>
                            </div>    
                                <div class="form-group col-md-6">
                                    <label>Total</label>
                                    <input type="number" class="form-control form-control-lg rounded-0" id="prc1" required="" >
                                    <div class="invalid-feedback">Oops, te ha faltado completar este campo</div>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-danger btn-lg float-right" id="btncancelar">CANCELAR</button>
                                <button type="submit" class="btn btn-success btn-lg float-right" id="btnCrear">CREAR</button>
                                <script>
                                      $("#btnCrear").click(function(event) {

                                      //Fetch form to apply custom Bootstrap validation
                                      var form = $("#formVenta")
 
                                      if (form[0].checkValidity() === false) {
                                           event.preventDefault()
                                           event.stopPropagation()
                                      }

                                      form.addClass('was-validated');
                                      });
                                </script>
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