<?php 
include '../components/header.components.php';


date_default_timezone_set('America/Tegucigalpa');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Compra</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css
" rel="stylesheet">
    
    <link href="../CSS/styleF.css" rel="stylesheet">

    <style>
        .item1 {
            display: none;
            }
    </style>

</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px; border: 1px solid black;">
       

        <div class="tab-content">
            <div id="pestaña1" class="tab-pane fade show active">
                <!-- Aquí va el formulario original -->
                    <div class="Formulario">
                        <div class="row">
                            <div class="Col-12" >
                                <h3 id="titulo" class="text-center">
                                    
                                </h3>
                                
                                
                            </div>
                            <div>
                            <div class="d-flex justify-content-end">
                                <a href=" javascript:history.back()" class="btn btn-danger" >
                                    Atras
                                </a>
                                </div>
                            </div>
                            <div class="col-12">
                                <form class="InsertCompra">
                                

                                <div class="col-12 mt-2 row">
                                    <div class="col-6">
                                        <label for="">FACTURA</label> 
                                        <input disabled type="text" id="txtFactura" class="form-control">
                                    </div>
                                    <div class="col-6">
                                    <label >ESTADO</label>
                                    <input disabled type="text" id="txtEstado" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 mt-2 row">
                                    <div class="col-6">
                                        <label for="">CLIENTE</label> 
                                        <input disabled type="text" id="txtCliente" class="form-control">
                                    </div>
                                    <div class="col-6">
                                    <label >FECHA DE VENTA</label>
                                    <input disabled type="date" id="Fecha_Compra" class="form-control" max=<?php $hoy=date("Y-m-d"); echo $hoy;?> pattern="\d{4}/\d{2}/\d{2}">
                                    </div>
                                </div>

                                

                                <div class="col-12 mt-2 row">
                                    <div class="col-6">
                                        <label for="">DESCUENTO APLICADO</label>
                                        <input disabled type="text" id="descuento" class="form-control" placeholder="Ingrese el total de la compra">
                                    </div>
                                    <div class="col-6">
                                        <label for="">PORCENTAJE DESCONTADO</label>
                                        <input disabled type="text" id="porcDescontado" class="form-control" placeholder="Ingrese el total de la compra">
                                    </div>
                                </div>
                                 
                                    
                                   
                                    
                                    <hr>
                                    <h3 id="titulo" class="text-center">
                                        Productos Vendidos
                                    </h3>
                                    <table  class="table table-hover text-nowrap">
                                    <thead class="">
                                       
                                        <tr>
                                            <th style="width: 100px">Código</th>
                                            <th style="width: 400">Nombre</th>
                                            <th style="width: 100">Cantidad</th>
                                            <th style="width: 100px">Precio</th>
                                            <th >Total</th>
   
                                        </tr>
                                    </thead>
                                    <tbody id="tablaVenta">
                                    
                                    </tbody>
                                
                                    
                                </table>
                                <div class="col-12 mt-2 row">
                                    <div class="col-6">
                                        
                                    </div>
                                    <div class="col-6">
                                    <label >Subtotal</label>
                                    <input disabled type="text" id="txtSubtotal" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 mt-2 row">
                                    <div class="col-6">
                                       
                                    </div>
                                    <div class="col-6">
                                    <label >Descuento</label>
                                    <input disabled type="text" id="txtDescuento" class="form-control">

                                    </div>
                                </div>
                                <div class="col-12 mt-2 row">
                                    <div class="col-6">
                                       
                                    </div>
                                    <div class="col-6">
                                    <label  id="impuestoLabel">IMPUESTO</label>
                                    <input disabled type="text" id="txtImpuesto" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 mt-2 row">
                                    <div class="col-6">
                                       
                                    </div>
                                    <div class="col-6">
                                    <label > TOTAL </label>
                                    <input disabled type="text" id="txtTotal" class="form-control">
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            
          <!--   <div id="pestaña3" class="tab-pane fade">
                
                <div class="Formulario">
                    <div class="row">
                        <div class="Col-12" id="titulo">
                            <h3>
                                Agregar Detalle del Producto Comprado
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="InsertDetalleProductoComprado">
                                <label for="">ID DETALLE COMPRA</label>
                                <input type="number" id="Id_Detalle_Compra" class="form-control" placeholder="Ingrese el código del detalle de la compra">
                                <label for="">ESPECIE</label>
                                    <input type="text" id="Especie" class="form-control" placeholder="Ingrese la especie">
                                <label for="">PESO VIVO</label>
                                <input type="number" id="PesoVivo" class="form-control" placeholder="Ingrese el peso vivo">
                                <label for="">CANAL</label>
                                <input type="number" id="Canal" class="form-control" placeholder="Ingrese el canal">
                                <label for="">RENDIMIENTO</label>
                                <input type="number" id="Rendimiento" class="form-control" placeholder="Ingrese el rendimiento">
                                <hr>
                                <div id="btnagregarDetalleProductoComprado">
                                    <input type="submit" id="btnagregarDPC" onclick="AgregarDetalleProductoComprado()" value="Agregar" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
     <div class="card-body table-responsive mt-4" id="tableCompra">
                               
                            </div>
    

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
<script src="../JS/Ventas.js"></script>
<script>listarVenta(<?=  $_GET["id"]  ?>)</script>
</body>
</html>
