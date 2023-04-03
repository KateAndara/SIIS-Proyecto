<?php 
include '../components/header.components.php';
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
    <script src="../JS/Compra.js"></script>
</head>
<body>
    <div class="col-md-12 cards-white" style="margin: 0 auto; width: 110%; max-width: none; margin-left: -20px;">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#pestaña1" style="color:black">Nueva compra</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pestaña2" style="color:black">Detalle de compra</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pestaña3" style="color:black">Detalle del producto comprado</a>
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
                                    <input type="date" id="Fecha_Compra" class="form-control" pattern="\d{4}/\d{2}/\d{2}">
                                    <label for="">TOTAL</label>
                                    <input type="number" id="Total" class="form-control" placeholder="Ingrese el total de la compra">
                                    <label for="">OBSERVACION</label>
                                    <input type="text" id="Observacion" class="form-control" placeholder="Ingrese si la compra fue al crédito o contado">
                                    <hr>
                                    <div id="btnagregarNuevaCompra">
                                        <input type="submit" id="btnagregarCompra" onclick="AgregarCompra()" value="Agregar" class="btn btn-success">
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
                                Agregar Detalle de la Compra
                            </h3>
                        </div>
                        <div class="col-12">
                            <form class="InsertDetalleCompra">
                                <label for="">ID COMPRA</label>
                                <input type="number" id="Id_Compra" class="form-control" placeholder="Ingrese el código de la compra">
                                <label for="">SELECCIONE UN PRODUCTO</label> 
                                <select id="Select_Producto" class="form-control">
                                    <option value="">Seleccione un producto</option>
                                </select>
                                <label for="">CANTIDAD</label>
                                <input type="number" id="Cantidad" class="form-control" placeholder="Ingrese ingrese la cantidad del producto">
                                <label for="">PRECIO LIBRA</label>
                                <input type="number" id="Precio_Libra" class="form-control" placeholder="Ingrese ingrese el precio por libra">
                                <hr>
                                <div id="btnagregarDetalleCompra">
                                    <input type="submit" id="btnagregarDetalle" onclick="AgregarDetalleCompra()" value="Agregar" class="btn btn-success">
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
            </div>
        </div>
    </div>
      

<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>