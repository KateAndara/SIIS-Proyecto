<?php 
include '../components/header.components.php';
$data="";
function getModal(string $nameModal, $data)
{
  $view_modal = "{$nameModal}.php";
  require_once $view_modal;
}

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


    <style>
        .item1 {
            display: none;
            }
    </style>

</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px;">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active"  id="nav1" data-toggle="tab" href="#pestaña1" style="color:black">Nueva compra</a>
            </li>
            <li class="nav-item" >
                <a class="nav-link" id="nav2"   href="#pestaña2" style="color:black">Detalle de compra</a>
            </li>
          
        </ul>

        <div class="tab-content">
            <div id="pestaña1" class="tab-pane fade show active">
                <!-- Aquí va el formulario original -->
                    <div class="Formulario">
                        <div class="row">
                            <div class="Col-12" id="titulo">
                                <h3>
                                    Nueva compra
                                </h3>
                            </div>
                            <div class="col-12">
                                <form class="InsertCompra">
                                    <label for="">SELECCIONE UN PROVEEDOR</label> 
                                    <select id="Select_Proveedor" class="form-control">
                                        <option value="">Seleccione un proveedor</option>
                                    </select>
                                    <label for="Fecha">FECHA DE COMPRA</label>
                                    <input type="date" id="Fecha_Compra" class="form-control" max=<?php $hoy=date("Y-m-d"); echo $hoy;?> pattern="\d{4}/\d{2}/\d{2}">
                                    <label for="">TOTAL</label>
                                    <input type="number" id="Total" class="form-control" placeholder="Ingrese el total de la compra">
                                    <label for="">OBSERVACION</label>
                                    <input type="text" id="Observacion" class="form-control" placeholder="Ingrese si la compra fue al crédito o contado">
                                    <hr>
                                    <div id="btnagregarNuevaCompra">
                                        <input type="button" id="btnagregarCompra" onclick="siguiente1()" value="Siguiente" class="btn btn-success">
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
            <div id="pestaña2" class="tab-pane fade">
                <!-- Aquí va el contenido de la segunda pestaña -->
                <div class="Formulario">
                    <div class="row">
                        <div class="Col-12" id="titulo">
                            <h3>
                                Agregar Detalle de la Compra
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="InsertDetalleCompra" id="InsertDetalleCompra">
                                <div class="col-12 mt-2 row">
                                    <div class="col-6">
                                        <label for="">SELECCIONE UN PRODUCTO</label> 
                                        <select id="Select_Producto" class="form-control">
                                            <option value="">Seleccione un producto</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <label for="">CANTIDAD</label>
                                       
                                        <input type="number" id="Cantidad" class="form-control" placeholder="Ingrese ingrese la cantidad del producto">
                                    </div>
                                </div>

                                <div class="col-12 mt-2 row">
                                    <div class="col-6">
                                        <label for="">PRECIO LIBRA</label>
                                        <input type="number" id="Precio_Libra" class="form-control" placeholder="Ingrese ingrese el precio por libra">
                                    </div>
                                    <div class="col-6">
                                    
                                    </div>
                                </div>
                               
                                <div class="Col-12 mt-2" id="titulo">
                                    <h3>
                                        Agregar Detalle del Producto Comprado
                                    </h3>
                                </div>


                                <div class="col-12 mt-2 row">
                                    <div class="col-6">
                                        <label for="">ESPECIE</label>
                                        <input type="text" id="Especie" class="form-control" placeholder="Ingrese la especie">
                                    </div>
                                    <div class="col-6">
                                        <label for="">PESO VIVO</label>
                                        <input type="number" id="PesoVivo" onkeyup="calcularRendimiento()" class="form-control" placeholder="Ingrese el peso vivo">
                                    </div>
                                </div>

                                <div class="col-12 mt-2 row">
                                    <div class="col-6">
                                    <label for="">CANAL</label>
                                        <input type="number" id="Canal" onkeyup="calcularRendimiento()" class="form-control" placeholder="Ingrese el canal">
                                    </div>
                                    <div class="col-6">
                                       
                                        <label for="">RENDIMIENTO</label>
                                        <input type="number" id="Rendimiento" class="form-control" placeholder="Ingrese el rendimiento">
                                    </div>
                                </div>
                               
                               
                                
                               
                              

                                <hr>
                                <div id="btnagregarDetalleCompra" class="d-flex justify-content-between">
                                    <div>
                                        <input type="button" id="btnagregarCompra" onclick="atras2()" value="Atras" class="btn btn-warning mr-2">
                                        <input type="button" id="btnagregarDetalle" onclick="AgregarDetalleCompra()" value="Agregar" class="btn btn-success">
                                    </div>
                                    <div>
                                    <input type="button" id="finalizaCompra" onclick="finalizarCompra()" value="Finalizar Compra" class="btn btn-info">
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
                                <table  class="table table-hover text-nowrap">
                                    <thead class="thead-dark">
                                       
                                        <tr>
                                            <th style="width: 100px">Código</th>
                                            <th style="width: 400px">Nombre</th>
                                            <th style="width: 100px">Cantidad</th>
                                            <th style="width: 100px">Precio</th>
                                            <th style="text-align-last:center">Editar</th>
                                            <th style="text-align-last:center">Eliminar</th>

                                        </tr>
                                    </thead>
                                    <tbody id="tablaCompra">
                                    <?=  getModal("tablaCompra",$data)  ?>
                                    </tbody>
                                
                                    
                                </table>
                            </div>
    

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="../JS/Compra.js"></script>
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
</body>
</html>
