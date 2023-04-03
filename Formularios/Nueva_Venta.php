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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../JS/Compra.js"></script>
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px;">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#pestaña1" style="color:black">Datos del Cliente</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pestaña2" style="color:black">Detalle de venta</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pestaña3" style="color:black">Promociones del Producto</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pestaña4" style="color:black">Descuentos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pestaña5" style="color:black">Total de la venta</a>
            </li>
        </ul>

        <div class="tab-content">
            <div id="pestaña1" class="tab-pane fade show active">
                <!-- Aquí va el formulario original -->
                <div id="pestaña1" class="tab-pane fade show active">
                    <div class="Formulario">
                        <div class="row">
                            <div class="Col-12" id="titulo">
                                <h3>
                                    Datos del Cliente
                                </h3>
                            </div>
                            <div class="col-12">
                                <form class="InsertCliente">
                                    <label for="">NOMBRE DEL CLIENTE</label> 
                                    <input type="text" id="Nombre" class="form-control" placeholder="Roberto...">
                                    <label for="Fecha">FECHA DE NACIMIENTO</label>
                                    <input type="date" id="FechaNacimiento" class="form-control" pattern="\d{4}/\d{2}/\d{2}">
                                    <label for="">DNI DEL CLIENTE</label>
                                    <input type="number" id="Dni" class="form-control" placeholder="Ingrese el total de la compra">
                                    <hr>
                                    <div id="btnagregarNuevoCliente">
                                        <input type="submit" id="btnagregarCliente" onclick="AgregarCliente()" value="Siguiente" class="btn btn-success">
                                    </div>
                                </form>
                            </div>
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
                                Agregar Detalle de la Venta
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="InsertDetalleVenta">
                                <label for="">ID VENTA</label>
                                <input type="number" id="Id_Venta" class="form-control" placeholder="Ingrese el código de la venta">
                                <label for="">SELECCIONE UN PRODUCTO</label> 
                                <select id="Select_Producto" class="form-control">
                                    <option value="">Seleccione un producto</option>
                                </select>
                                <label for="">CANTIDAD</label>
                                <input type="number" id="Cantidad" class="form-control" placeholder="Ingrese ingrese la cantidad del producto">
                                <label for="">PRECIO </label>
                                <input type="number" id="Precio" class="form-control" placeholder="Ingrese ingrese el precio por libra">
                                <hr>
                                <div id="btnagregarDetalleVenta">
                                    <input type="submit" id="btnagregarDetalle" onclick="AgregarDetalleVenta()" value="Agregar" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pestaña3" class="tab-pane fade">
                <!-- Aquí va el contenido de la tercera pestaña -->
                <div class="Formulario">
                    <div class="row">
                        <div class="Col-12" id="titulo">
                            <h3>
                                Agregar Promociones 
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="Insertpromociones">
                                <label for="">SELECCIONE UNA PROMOCION</label> 
                                <select id="Select_Promocion" class="form-control">
                                    <option value="">Seleccione una promocion</option>
                                </select>
                                <label for=""><P>Nuevo Precio de Venta</P></label>
                                <input type="number" id="Porcentaje" class="form-control" placeholder="Porcentaje...">
                                <hr>
                                <div id="btnagregarPromocion">
                                    <input type="submit" id="btnagregarPromocion" onclick="AgregarPromocion()" value="Agregar" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pestaña4" class="tab-pane fade">
                <!-- Aquí va el contenido de la cuarta pestaña -->
                <div class="Formulario">
                    <div class="row">
                        <div class="Col-12" id="titulo">
                            <h3>
                                Agregar Descuentos 
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="InsertDescuento">
                                <label for="">SELECCIONE UN DESCUENTO</label> 
                                <select id="Select_Descuento" class="form-control">
                                    <option value="">Seleccione un descuento</option>
                                </select>
                                <label for=""><P>PORCENTAJE DEL DESCUENTO</P></label>
                                <input type="number" id="Porcentaje" class="form-control" placeholder="Porcentaje...">
                                <label for="">TOTAL DESCONTADO </label>
                                <input type="number" id="Total descontado" class="form-control" placeholder="Total descontado...">
                                <hr>
                                <div id="btnagregarDescuento">
                                    <input type="submit" id="btnagregarDescuento" onclick="AgregarDescuento()" value="Agregar" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="pestaña5" class="tab-pane fade">
                <!-- Aquí va el contenido de la quinta pestaña -->
                <div class="Formulario">
                    <div class="row">
                        <div class="Col-12" id="titulo">
                            <h3>
                                Agregar Venta
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="InsertVenta">
                                <label for="">ESTADO DE VENTA</label> 
                                <select id="Select_Descuento" class="form-control">
                                    <option value="">Seleccione un estado de venta</option>
                                </select>
                                <label for=""><P>SUBTOTAL</P></label>
                                <input type="number" id="Subtotal" class="form-control" placeholder="Subtotal...">
                                <label for=""><P>IMPUESTO</P></label>
                                <input type="number" id="Impuesto" class="form-control" placeholder="Impuesto...">
                                <label for="">TOTAL</label>
                                <input type="number" id="Total" class="form-control" placeholder="Total...">
                                <hr>
                                <div id="btnagregarVenta">
                                    <input type="submit" id="btnagregarVenta" onclick="AgregarVenta()" value="Agregar" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>
